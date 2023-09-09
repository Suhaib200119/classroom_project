<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "user_image"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // motitor
    // تستخدم حتلى تقوم بعمل شيء اتريبوت في عملية التخزين في الداتابيز
    // set{AttributeName}Attribute
    public function setEmailAttribute($value){
        $this->attributes["email"]=strtolower($value);
    }

  // return only all users
  public function classrooms()
  {
      return $this->belongsToMany(
          Classroom::class, // related model
          "classrooms_users", // pivot table
          "user_id", // fk for current model in pivot table
          "classroom_id", // fk for related model in pivot table
          "id", // pk for current model
          "id" // pk for related model
      )->withPivot(["role","classroom_id","created_at"]); // تكتب اسماء الاعمدة اللي بدك تجيبها من الجدول الوسيط
  }
  // [wherePivot] use to make condition on relation method 
    public function comments(){
        return $this->hasMany(Comment::class,"user_id","id");
    }
    public function posts(){
        return $this->hasMany(Post::class,"user_id","id");
    }

    public function submissions(){
        return $this->hasMany(Submission::class);
    }

    public function classworks(){
        return $this->belongsToMany(Classwork::class);
    }

    // public function routeNotificationForMail( $notification = null)
    // {
    //     return $this->email;
    // }

    public function routeNotificationForVonage($notification=null): string
    {
        return $this->phone_number;// "972592369923"
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
}
