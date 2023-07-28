<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicsRequset;
use App\Models\Classroom;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::withTrashed()->where("user_id",Auth::id())->get();
        return view("Topics.index", ["topics" => $topics]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::withoutTrashed()->get(["name", "id"]);
        if(count($classrooms)>0){
        return view("Topics.create")->with("classrooms", $classrooms);
            
        }else{
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TopicsRequset $request)
    {
        $validation = $request->validated();
        $topic = new Topic();
        $topic->name = $request->post("name");
        $topic->classroom_id = $request->post("classroom_id");
        $topic->user_id = Auth::id();
        if ($topic->save()) {
            Session::flash("success", "تم إضافة الموضوع بنجاح");
        } else {
            Session::flash("danger", "لم تتم عملية إضافة الموضوع بنجاح");
        }

        return redirect()->route("topics.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $topic = Topic::withTrashed()->findOrFail($id);
        if ($topic != null) {
            return view("Topics.show")->with("topic", $topic);
        } else {
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classrooms = Classroom::withoutTrashed()->get(["name", "id"]);
        $topic = Topic::withoutTrashed()->find($id);
        if($topic!=null){
            return view("Topics.edit", [
                "classrooms" => $classrooms,
                "topic" => $topic,
            ]);
        }else{
            return back();
        }
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TopicsRequset $request, string $id)
    {
        $validation = $request->validated();
        $topic = Topic::findOrFail($id);
        $topic->name = $request->post("name");
        $topic->classroom_id = $request->post("classroom_id");
        $topic->user_id = 1;
        if ($topic->save()) {
            Session::flash("success", "تم تحديث الموضوع بنجاح");
        } else {
            Session::flash("danger", "لم تتم عملية تحديث الفصل الدراسي بنجاح");
        }

        return redirect()->route("topics.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Topic::destroy($id) > 0) {
            Session::flash("success", "تم حذف الفصل الدراسي مع إمكانية استرجاعه");
        } else {
            Session::flash("danger", "لم تتم عملية الحذف بنجاح");
        }

        return redirect()->route("topics.index");
    }


    public function forceDelete(String $id)
    {
        $topic = Topic::onlyTrashed()->findOrFail($id);
        if ($topic->forceDelete()) {
            Session::flash("success", "نم حذف الموضوع بشكل نهائي");
        }
        return redirect()->route("topics.index");
    }


    public function restore(String $id){
        $topic=Topic::onlyTrashed()->findOrFail($id);
        $topic->restore();
        return redirect()->route("topics.index");
    }
}
