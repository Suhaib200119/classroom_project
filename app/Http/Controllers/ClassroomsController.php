<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomsRequest;
use App\Models\Classroom;
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
        $classrooms=Classroom::all();
        return view("Classrooms.index")->with("classrooms",$classrooms);
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
    $request->validate(
        [
            "cover_image"=>["required",Rule::imageFile()],
        ],
        [
            "required"=>":attribute is required!",
        ]
    );
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
        $classroom=Classroom::findOrFail($id);
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
    public function destroy(string $id)
    {
        $classroom=Classroom::findOrFail($id);
        unlink(public_path("uploads/".$classroom->cover_image));
        Classroom::destroy($id);
        return redirect()->route("index_classroom");
    }
}
