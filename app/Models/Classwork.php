<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classwork extends Model
{
    use HasFactory;
    const TYPE_ASSIGNMENT="assignment";
    const TYPE_MATERIAL="material";
    const TYPE_QUESTION="question";
    const STATUS_PUBLISHED="published";
    const STATUS_DRAFT="draft";

    public function classroom(){
        return $this->belongsTo(Classroom::class,"classroom_id","id");
    }
    public function topic(){
        return $this->belongsTo(Topic::class,"topic_id","id");
    }

    public function users(){
        return $this->belongsToMany(User::class)->withPivot(
            ["user_id","grade","submitted_at","status","created_at"]
        )->using(ClassworkUser::class);
    }
    public function user(){
        return $this->belongsTo(Classwork::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class,"commentable")->latest();
    }

    public function submissions(){
        return $this->hasMany(Submission::class);
    }
}
