<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomsRequest;
use App\Models\Classroom;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::withoutTrashed()->where("user_id", Auth::id())->get();
        return view("Classrooms.index")->with("classrooms", $classrooms);
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
        $classroom->user_id = 1;
        $classroom->name = $request->post("name");
        $classroom->code = Str::random(10);
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
            Session::flash("success", "تم لإصافة الفصل الدراسي بنجاح");
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
        $urlJoinPage = URL::signedRoute("join_Classroom_create", [
            "id" => $id,
            "code" => $classroom->code
        ]);
        return view("Classrooms.show", [
            "classroom" => $classroom,
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
            Session::flash("success", "تم حذف الفصل الدراسي مع إمكانيه استرجاعه");
        } else {
            Session::flash("danger", "لم تتم عملية الحذف بنجاح");
        }
        return redirect()->route("index_classroom");
    }

    public function forceDelete(String $id)
    {
        $classroom = Classroom::onlyTrashed()->findOrFail($id);
        unlink(public_path("uploads/" . $classroom->cover_image));
        if ($classroom->forceDelete()) {
            Session::flash("success", "تم حذف الفصل الدراسي بنجاح");
        } else {
            Session::flash("danger", "لم تمم عملية الحذف بنجاح");
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

    
}
