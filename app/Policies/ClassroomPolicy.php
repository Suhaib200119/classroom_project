<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassroomPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function showClassroom($user,$classroom){
        return DB::table('classrooms_users')
        ->where("user_id","=",$user->id)
        ->where("classroom_id","=",$classroom->id)
        ->exists();
    }
}
