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
    //acceccors 
    // تقوم بتطبيق شيء معين على الاتريبوت في جميع الاماكن
    // مثل جعل حروف الاسم كبيرة

    // شروط تسمية الاكسيسور get{Attribute Name}Attribute
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

    // هنا بعمل اكسيسور ل الروات
    //    public function getUrlAttribute(){
    //         return route("show_classroom",$this->id);
    //     }

    // motitor
    // تستخدم حتلى تقوم بعمل شيء اتريبوت في عملية التخزين في الداتابيز
    // set{AttributeName}Attribute
    public function setSectionAttribute($value)
    {
        $this->attributes["section"] = strtolower($value);
    }

    protected static function booted()
    {
        

        //  model في observer ربط 
        static::observe(ClassroomObserver::class);

       
    }
}
