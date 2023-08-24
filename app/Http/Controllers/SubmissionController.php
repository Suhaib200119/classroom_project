<?php

namespace App\Http\Controllers;

use App\Models\Classwork;
use App\Models\ClassworkUser;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function store(Request $request, String $id)
    {
        $request->validate(
            [
                "files" => "required"
            ]
        );

        $classwork = Classwork::findOrFail($id);
        $assigned = $classwork->users()->where("user_id", Auth::id())->exists();
        if (!$assigned) {
            abort(403);
        }
        DB::transaction(function () use($id,$classwork,$request) {
            foreach ($request->file("files") as $file) {
                $path = $file->store("/submissions/{$classwork->title}", "uploads");
                $submission = new Submission();
                $submission->user_id = Auth::id();
                $submission->classwork_id = $id;
                $submission->content = $path;
                $submission->content_type = "file";
            }
            if ($submission->save()) {
                ClassworkUser::where([
                    "user_id"=>Auth::id(),
                    "classwork_id"=>$id
                ])->update(
                    [
                        "status" => "submitted",
                        "submitted_at" => now(),
                    ]
                );
            }
        });
      
        return back()->with("success", "Work Submitted");
    }
}
