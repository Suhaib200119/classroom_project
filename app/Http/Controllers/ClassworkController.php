<?php

namespace App\Http\Controllers;

use App\Events\ClassworkCreated;
use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\ClassworkUser;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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
            ->where(function($query){
                $query->whereHas("users",function($query){
                    $query->where("id","=",Auth::id());
                })
                ->orWhereHas("classroom.teachers",function($query){
                            $query->where("id","=",Auth::id());
                        });
            })
            ->get();

        $materials = $classroom->classworks()
            ->orderBy("published_at")
            ->where("types", "=", Classwork::TYPE_MATERIAL)
            ->where(function($query){
                $query->whereHas("users",function($query){
                    $query->where("id","=",Auth::id());
                })
                ->orWhereHas("classroom.teachers",function($query){
                            $query->where("id","=",Auth::id());
                        });
            })
            ->get();

        $questions = $classroom->classworks()
            ->orderBy("published_at")
            ->where("types", "=", Classwork::TYPE_QUESTION)
            ->where(function($query){
                $query->whereHas("users",function($query){
                    $query->where("id","=",Auth::id());
                })
                ->orWhereHas("classroom.teachers",function($query){
                            $query->where("id","=",Auth::id());
                        });
            })
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

        $this->authorize("create", [Classwork::class,$classroom]);
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
                "grade" => ["required_if:types,assignment"],
                "due" => ["required_if:types,assignment", "after:published_at"]
            ],
        );
        $idsUsers = $request->post("std");
        if ($idsUsers == null) {
            Session::flash("danger", "يجب عليك تحديد الاشخاص الذي سيظهر لهم العمل");
            return back();
        }
        DB::transaction(function () use ($request, $classroom, $idsUsers) {
            $classwork = new Classwork();
            $classwork->title = $request->post("title");
            $classwork->description = $request->post("description");
            $classwork->user_id = Auth::id();
            $classwork->classroom_id = $classroom->id;
            $classwork->topic_id = $request->post("topic_id");
            $classwork->types = $request->post("types");
            $classwork->status = $request->post("status");
            $classwork->published_at = $request->post("published_at");
            $options_json = json_encode(
                [
                    "grade" => $request->post("grade"),
                    "due" => $request->post("due")
                ]
            );
            $classwork->options = $options_json;
            $classwork->save();
            // $classwork->users()->attach($request->input("std"));
            foreach ($idsUsers as $id) {
                $classwork_user = new ClassworkUser();
                $classwork_user->user_id = $id;
                $classwork_user->classwork_id = $classwork->id;
                $classwork_user->save();
            }
            ClassworkCreated::dispatch($classwork);
        });

        Session::flash("success", "تم إضافة العمل بنجاح");
        return redirect()->route("classrooms.classworks.index", $classroom->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom, Classwork $classwork)
    {
        $this->authorize("view", $classwork);
        $submissions = Submission::where(
            [
                "user_id" => Auth::id(),
                "classwork_id" => $classwork->id
            ]
        )->get();

        return view("classworks.show", [
            "classroom" => $classroom,
            "classwork" => $classwork,
            "submissions" => $submissions,
        ]);
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
