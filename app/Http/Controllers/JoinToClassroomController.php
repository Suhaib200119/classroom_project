<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JoinToClassroomController extends Controller
{
    public function joinToClassroomCreate(String $id)
    {
       $isExists= DB::table("classrooms_users")
       ->where("user_id","=",Auth::id(),"and","classroom_id","=",$id)
       ->exists();
        if(!$isExists){
            $classroom = Classroom::withoutTrashed()->findOrFail($id);
            return view("Classrooms.join", ["classroom" => $classroom]);
        }else{
            return redirect()->route("show_classroom",$id);
        }
        
    }
    public function joinToClassroomStore(Request $request , String $id)
    {

      $isSaved= DB::table("classrooms_users")->insert([
        "classroom_id"=>$id,
        "user_id"=>Auth::id(),
        "role"=>$request->post("role")
       ]);

       if($isSaved){
        $classroom=Classroom::withTrashed()->findOrFail($id);
        Session::flash("success","You Joind Into Classroom $classroom->name");
        return redirect()->route("show_classroom",$id);
       }else{
        return back();
       }
      
    }

    public function exitFromClassroom(String $id){
       $count= DB::table("classrooms_users")
       ->where("classroom_id",$id)
       ->where("user_id",Auth::id())
       ->delete();
       if($count>0){
        Session::flash("message","تم مغادرة الفصل بنجاح");
        return back();
       }
    }

    public function classroomsStudent(){
        $classrooms=DB::table("classrooms_users")
        ->where("user_id","=",Auth::id())->where("role","=","student")->get();
        return view("Classrooms.classrooms_j_student",["classrooms"=>$classrooms]);
    }

    public function classroomsTeacherr(){
        $classrooms=DB::table("classrooms_users")
        ->where("user_id","=",Auth::id())->where("role","=","teacher")->get();
             return view("Classrooms.classrooms_j_teacher",["classrooms"=>$classrooms]);
    }
}
