<?php

namespace App\Models;

use App\Observers\ClassroomObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    // public function getCoverImageAttribute($value){
    //     if($value){
            
    //         return asset("uploads/$value");
    //     }else{
    //         return url("https://placehold.co/800x200");
    //     }
    // }
    // url().

    public function setSectionAttribute($value)
    {
        $this->attributes["section"] = strtolower($value);
    }

    protected static function booted()
    {
        //  model في observer ربط 
        static::observe(ClassroomObserver::class);
    }
    // return only all users
    public function users()
    {
        return $this->belongsToMany(
            User::class, // related model
            "classrooms_users", // pivot table
            "classroom_id", // fk for current model in pivot table
            "user_id", // fk for related model in pivot table
            "id", // pk for current model
            "id" // pk for related model
        )->withPivot(["role","classroom_id"]); // تكتب اسماء الاعمدة اللي بدك تجيبها من الجدول الوسيط
    }
    // [wherePivot] use to make condition on relation method 
    // return only teachers
    public function teachers()
    {
        return  $this->users()->wherePivot("role", "=", "teacher");
    }
    // return only students
    public function students()
    {
        //use to make condition on relation method 
        return  $this->users()->wherePivot("role", "=", "student");
    }

    public function classworks()
    {
        return $this->hasMany(Classwork::class, "classroom_id", "id");
    }

    public function topics()
    {
        return $this->hasMany(Topic::class, "classroom_id", "id");
    }

    public function posts(){
            return $this->hasMany(Post::class,"classroom_id","id");
        }

}
