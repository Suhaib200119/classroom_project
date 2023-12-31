<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomsRequest;
use App\Models\Classroom;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $classrooms = Classroom::withoutTrashed()
        ->where("user_id", Auth::id());
        if ($request->has("search")){
            $classrooms->where("name","LIKE","%$request->search%");
        }
        return view("Classrooms.index")->with("classrooms", $classrooms->get());
    }
    public function trashedClassrooms()
    {
        $classrooms = Classroom::onlyTrashed()->get();
        return view("Classrooms.trashedClassrooms", ["classrooms" => $classrooms]);
    }
    // public function withOutTrashedClassrooms(){
    //     $classrooms=Classroom::withoutTrashed()->get();
    //     return view("Classrooms.withOutClassrooms",["classrooms"=>$classrooms]);

    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Classrooms.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomsRequest $request)
    {
        $validation = $request->validated();
        $classroom = new Classroom();
        // model في  event تم نقلهم إلى دالة  
        // $classroom->user_id = Auth::id();
        // $classroom->code = Str::random(10);
        $classroom->name = $request->post("name");
        $classroom->section = $request->post("section");
        $classroom->subject = $request->post("subject");
        $classroom->room = $request->post("room");
        $classroom->status = $request->post("status");
        if ($request->hasFile("cover_image")) { //  الشرط غير ضروري لأنه حقل إدخال الصورة إجباري
            $file = $request->file("cover_image");
            $path = $file->store("/covers", "uploads");
            $classroom->cover_image = $path;
        }

        if ($classroom->save()) {
            Session::flash("success", "تم إضافة الفصل الدراسي بنجاح");
            DB::table("classrooms_users")->insert([
                "classroom_id" => $classroom->id,
                "user_id" => Auth::id(),
                "role" => "teacher",
                "owner"=>"yes"
            ]);
        } else {
            Session::flash("danger", "لم تتم عملية إضافة الفصل الدراسي بنجاح");
        }
        return redirect()->route("index_classroom");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classroom = Classroom::withTrashed()->findOrFail($id);
        $this->authorize("showClassroom",$classroom);
        $posts=$classroom->posts()->latest()->get();
        $urlJoinPage = URL::signedRoute("join_Classroom_create", [
            "id" => $id,
            "code" => $classroom->code
        ]);
        return view("Classrooms.show", [
            "classroom" => $classroom,
            "posts"=>$posts,
            "urlJoinPage" => $urlJoinPage,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classroom = Classroom::findOrFail($id);
        return view("Classrooms.edit", [
            "classroom" => $classroom
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassroomsRequest $request, string $id)
    {
        $validation = $request->validated();

        $classroom = Classroom::findOrFail($id);
        $classroom->name = $request->post("name");
        $classroom->section = $request->post("section");
        $classroom->subject = $request->post("subject");
        $classroom->room = $request->post("room");
        $classroom->status = $request->post("status");
        if ($request->hasFile("cover_image")) {
            unlink(public_path("uploads/" . $classroom->cover_image));
            $file = $request->file("cover_image");
            $path = $file->store("/covers", "uploads");
            $classroom->cover_image = $path;
        }

        if ($classroom->save()) {
            Session::flash("success", "تم تحديث الفصل الدراسي بنجاح");
        } else {
            Session::flash("danger", "لم تتم عملية تحديث الفصل الدراسي");
        }
        return redirect()->route("index_classroom");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) // soft delete
    {
        $classroom = Classroom::withoutTrashed()->findOrFail($id);
        if ($classroom->delete()) {
            return response()->json([
                "message" => "تم حذف الفصل الدراسي مع إمكانيه استرجاعه",
            ], 200);
        } else {
            return response()->json([
                "message" => "لم تتم عملية الحذف بنجاح",
            ], 400);
        }
        return redirect()->route("index_classroom");
    }

    public function forceDelete(String $id)
    {
        $isDeleted = Classroom::where("id", "=", $id)->forceDelete();
        // model في event تم  نقل الكود إالى دالة  
        // unlink(public_path("uploads/" . $classroom->cover_image));
        if ($isDeleted) {
            return response()->json(["message" => "نم حذف الفصل الدراسي بشكل نهائي"], 200);
        }

        return redirect()->route("trashed_classroom");
    }

    public function restore(String $id)
    {
        $classroom = Classroom::onlyTrashed()->findOrFail($id);
        $classroom->restore();
        Session::flash("success", "تم استرجاع الفصل الدراسي");
        return redirect()->route("index_classroom");
    }

    public function people($id)
    {
       $obj = DB::table("classrooms_users")
            ->where("user_id", "=", Auth::id())
            ->where("classroom_id", "=", $id)->first();
        if ($obj) {
            $owner=$obj->owner;
            $classroom = Classroom::withoutTrashed()->findOrFail($id);
            $teachers = $classroom->teachers()->get();
            $students = $classroom->students()->get();
            return view("Classrooms.people", [
                "classroom" => $classroom,
                "teachers" => $teachers,
                "students" => $students,
                "owner"=>$owner
            ]);
        }else{
            return redirect()->route("index_classroom");
        }
    }

    
}
