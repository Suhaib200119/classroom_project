<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomsRequest;
use App\Models\Classroom;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms=Classroom::withTrashed()->get();
        return view("Classrooms.index")->with("classrooms",$classrooms);
    }

    public function trashedClassrooms(){
        $classrooms=Classroom::onlyTrashed()->get();
        return view("Classrooms.trashedClassrooms",["classrooms"=>$classrooms]);
    }
    public function withOutTrashedClassrooms(){
        $classrooms=Classroom::withoutTrashed()->get();
        return view("Classrooms.withOutClassrooms",["classrooms"=>$classrooms]);

    }

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
    $validation=$request->validated();
    $classroom=new Classroom();
    $classroom->user_id=1;
    $classroom->name=$request->post("name");
    $classroom->code=Str::random(10); 
    $classroom->section=$request->post("section");
    $classroom->subject=$request->post("subject");
    $classroom->room=$request->post("room");
    $classroom->status=$request->post("status");
    if($request->hasFile("cover_image")){ //  الشرط غير ضروري لأنه حقل إدخال الصورة إجباري
        $file=$request->file("cover_image");
        $path=$file->store("/covers","uploads");
        $classroom->cover_image=$path;
    }

    if($classroom->save()){
        Session::flash("success","classroom insertion");
    }else{
        Session::flash("danger","classroom dosent insertion");
    }
    return redirect()->route("index_classroom");


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classroom=Classroom::withTrashed()->findOrFail($id);
        return view("Classrooms.show",[
            "classroom"=>$classroom
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classroom=Classroom::findOrFail($id);
        return view("Classrooms.edit",[
            "classroom"=>$classroom
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassroomsRequest $request, string $id)
    {
    $validation=$request->validated();
 
    $classroom=Classroom::findOrFail($id);
    $classroom->name=$request->post("name");
    $classroom->section=$request->post("section");
    $classroom->subject=$request->post("subject");
    $classroom->room=$request->post("room");
    $classroom->status=$request->post("status");
    if($request->hasFile("cover_image")){
        unlink(public_path("uploads/".$classroom->cover_image));
        $file=$request->file("cover_image");
        $path=$file->store("/covers","uploads");
        $classroom->cover_image=$path;
    }

    if($classroom->save()){
        Session::flash("success","classroom updated");
    }else{
        Session::flash("danger","classroom dosent updated");
    }
    return redirect()->route("index_classroom");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) // soft delete
    {
        $classroom=Classroom::withoutTrashed()->findOrFail($id);
        if($classroom->delete()){
            Session::flash("success","classroom deleted");
        }else{
            Session::flash("danger","classroom not deleted !");
        }
        return redirect()->route("withOutTrashed_classroom");
    }

    public function forceDelete(String $id){
        $classroom=Classroom::onlyTrashed()->findOrFail($id);
        unlink(public_path("uploads/".$classroom->cover_image));
        if($classroom->forceDelete()){
            Session::flash("success","classroom deleted");
        }else{
            Session::flash("danger","classroom not deleted !");
        }
        return redirect()->route("trashed_classroom");
    }

    public function restore(String $id){
        $classroom=Classroom::onlyTrashed()->findOrFail($id);
        $classroom->restore();
        Session::flash("success","classroom restored");
        return redirect()->route("withOutTrashed_classroom");

    }
}
