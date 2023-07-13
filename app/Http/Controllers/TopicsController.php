<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::all();
        return view("Topics.index", ["topics" => $topics]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::get(["name", "id"]);
        return view("Topics.create")->with("classrooms", $classrooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $topic = new Topic();
        $topic->name = $request->post("name");
        $topic->classroom_id = $request->post("classroom_id");
        $topic->user_id = 1;
        if ($topic->save()) {
            Session::flash("success", "Topic insertion");
        } else {
            Session::flash("danger", "Topic not insertion");
        }

        return redirect()->route("topics.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $topic = Topic::findOrFail($id);
        return view("Topics.show")->with("topic",$topic);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classrooms = Classroom::get(["name", "id"]);
        $topic = Topic::findOrFail($id);
        return view("Topics.edit", [
            "classrooms" => $classrooms,
            "topic" => $topic,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->name = $request->post("name");
        $topic->classroom_id = $request->post("classroom_id");
        $topic->user_id = 1;
        if ($topic->save()) {
            Session::flash("success", "Topic updated");
        } else {
            Session::flash("danger", "Topic not updated");
        }

        return redirect()->route("topics.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Topic::destroy($id) > 0) {
            Session::flash("success", "topic deleted");
        } else {
            Session::flash("danger", "topic not deleted");
        }

        return redirect()->route("topics.index");
    }
}
