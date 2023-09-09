<?php

namespace App\Listeners;

use App\Events\JoinToClassroomEvent;
use App\Models\User;
use App\Notifications\JoinToClassroomNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class JoinToClassroomListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(JoinToClassroomEvent $event): void
    {
      // dd(User::find($event->classroom->user_id));
      Notification::send(
        User::find($event->classroom->user_id),
        new JoinToClassroomNotification($event->classroom,$event->user),
      );
    }
}
