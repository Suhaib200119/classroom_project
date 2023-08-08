<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){
        $validation=$request->validate(
            [
                "content"=>"required"
            ],
            [
                "content.required"=>"يجب أن تدخل التعليق"
            ]
        );
        $comment=new Comment();
        $comment->user_id =Auth::id();
        $comment->content=$request->post("content");
        $comment->ip=$request->ip();
        $comment->user_agent=$request->header("user-agent");
        $comment->commentable_id=$request->post("id");
        $comment->commentable_type="App\Models\\".$request->post("type");
        $comment->save();
        return back();

    }
}
