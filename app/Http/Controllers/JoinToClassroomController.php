<?php

namespace App\Http\Controllers;

use App\Events\JoinToClassroomEvent;
use App\Models\Classroom;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JoinToClassroomController extends Controller
{
    public function joinToClassroomCreate(String $id)
    {
        $isExists = DB::table("classrooms_users")
            ->where("user_id", "=", Auth::id())
            ->where("classroom_id", "=", $id)
            ->exists();
        if (!$isExists) {
            $classroom = Classroom::withoutTrashed()->findOrFail($id);
            return view("Classrooms.join", ["classroom" => $classroom]);
        } else {
            return redirect()->route("show_classroom", $id);
        }
    }
    public function joinToClassroomStore(Request $request, String $id)
    {
        // find id for the owner classroom 
        $ownerClassroomId=DB::table("classrooms_users")
        ->where("classroom_id","=",$id)->first("user_id")->user_id;

        // finding the allow number of student for classroom in the last subscription for the owner classroom by id
        $allowNumberOfStudent=Subscription::where("user_id","=",$ownerClassroomId)
        ->orderBy("created_at","DESC")->first()->plan
        ->features()
        ->where("code","=","classrooms-students")
        ->first(["feature_value"])->feature_value;
        

        //find the number of student in classroom
        $numberOfStudentInClassroom= DB::table("classrooms_users")
        ->where("classroom_id","=",$id)
        ->where("owner","=","no")
        ->count();
       
        // check if the numberOfStudent in classroom less than allow number of student for classroom in the last subscription
        if($allowNumberOfStudent>$numberOfStudentInClassroom){
            $isSaved = DB::table("classrooms_users")->insert([
                "classroom_id" => $id,
                "user_id" => Auth::id(),
                "role" => $request->post("role"),
                "owner"=>"no"
            ]);
    
            if ($isSaved) {
                $classroom = Classroom::withTrashed()->findOrFail($id);
                Session::flash("success", "تم إنضمامك إلى الفصل  $classroom->name");
                JoinToClassroomEvent::dispatch(Auth::user(),$classroom);
                return redirect()->route("show_classroom", $id);
            } else {
                return back();
            }
        }else{
            abort(403,"cannot be joined for the classroom");
        }

        
    }

    public function myClassroom(){
        $user=User::findOrFail(Auth::id());
        $classrooms=$user->classrooms;
        return view("Classrooms.myClassroomsJoin",[
            "classrooms"=>$classrooms,
            "user_id"=>Auth::id()
        ]);
    }
    public function exitFromClassroom(String $classroom_id,String $user_id)
    {
        $count = DB::table("classrooms_users")
            ->where("classroom_id", $classroom_id)
            ->where("user_id", $user_id)
            ->delete();
            // dd($count);
        if ($count > 0) {
            return response()->json(["message" => "تم مغادرة الفصل بنجاح"], 200);
        }
    }



  

   
}
