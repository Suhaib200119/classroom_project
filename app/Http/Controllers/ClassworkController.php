<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\ClassworkUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClassworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Classroom $classroom)
    {
        //     $classworks=$classroom->classworks()
        //         ->with("topic")
        //         ->orderBy("published_at")
        //         ->get();

        //     return view("classworks.index",[
        //     "classroom"=>$classroom,
        //     "classworks"=>$classworks,
        // ]);


        $assignments = $classroom->classworks()
            ->orderBy("published_at")
            ->where("types", "=", Classwork::TYPE_ASSIGNMENT)
            ->get();

        $materials = $classroom->classworks()
            ->orderBy("published_at")
            ->where("types", "=", Classwork::TYPE_MATERIAL)
            ->get();

        $questions = $classroom->classworks()
            ->orderBy("published_at")
            ->where("types", "=", Classwork::TYPE_QUESTION)
            ->get();

        return view("classworks.index", [
            "classroom" => $classroom,
            "assignments" => $assignments,
            "materials" => $materials,
            "questions" => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Classroom $classroom)
    {
        $topics = $classroom->topics;
        $students = $classroom->students()->get();
        $type = $request->query("type");
        $types = [
            Classwork::TYPE_ASSIGNMENT,
            Classwork::TYPE_MATERIAL,
            Classwork::TYPE_QUESTION
        ];
        if (!in_array($type, $types)) {
            abort(404);
        }
        return view("classworks.create", [
            "classroom" => $classroom,
            "topics" => $topics,
            "type" => $type,
            "students" => $students

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Classroom $classroom)
    {
        $request->validate(
            [
                "title" => ["required", "string", "max:255"],
                "description" => ["nullable", "string"],
                "topic_id" => ["required", "int", "exists:topics,id"],
            ],
        );
        $idsUsers = $request->post("std");
        if($idsUsers==null){
            Session::flash("danger", "يجب عليك تحديد الاشخاص الذي سيظهر لهم العمل");
            return back();
        }
        $classwork = new Classwork();
        $classwork->title = $request->post("title");
        $classwork->description = $request->post("description");
        $classwork->user_id = Auth::id();
        $classwork->classroom_id = $classroom->id;
        $classwork->topic_id = $request->post("topic_id");
        $classwork->types = $request->post("types");
        $classwork->status=$request->post("status");
        $classwork->published_at=$request->post("published_at");
        // $classwork->options=$request()->post("options");
        $classwork->save();
        
        foreach ($idsUsers as $id) {
            $classwork_user = new ClassworkUser();
            $classwork_user->user_id = $id;
            $classwork_user->classwork_id = $classwork->id;
            $classwork_user->save();
        }
       Session::flash("success", "تم إضافة العمل بنجاح");
        return redirect()->route("classrooms.classworks.index", $classroom->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom, Classwork $classwork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom, Classwork $classwork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom, Classwork $classwork)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom, Classwork $classwork)
    {
        //
    }
}
