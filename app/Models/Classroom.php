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

    
    public function setSectionAttribute($value)
    {
        $this->attributes["section"] = strtolower($value);
    }

    protected static function booted()
    {
        //  model في observer ربط 
        static::observe(ClassroomObserver::class);
       
    }

    
    public function classworks(){
        return $this->hasMany(Classwork::class,"classroom_id","id");
    }
    public function topics(){
        return $this->hasMany(Topic::class,"classroom_id","id");
    }
}
