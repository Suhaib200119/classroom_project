<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel("classroom.{id}",function($user,$id){
//     return $user->classrooms()->where("id","=",$id)->exists();
// });

// Broadcast::channel("add-submission.{user_id}",function($user,$user_id){
//     return $user->id == $user_id;
// });

// Broadcast::channel("join-to-classroom.{ownerClassroomId}",function($user,$ownerClassroomId){
//     return $user->id == $ownerClassroomId;
// });
