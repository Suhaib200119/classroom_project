<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request, string $id)
    {
        $request->validate(
            [
                "post_content" => "required",
            ],
            [
                "post_content.required" => "يجب كتابة المنشور قبل الارسال"
            ]
        );
        $post = new Post();
        $post->classroom_id = $id;
        $post->user_id = Auth::id();
        $post->post_content = $request->post("post_content");
        $post->save();
        return back();
        // dd($request->all());
    }
}
