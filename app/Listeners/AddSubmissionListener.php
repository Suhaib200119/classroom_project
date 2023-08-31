<?php

namespace App\Listeners;

use App\Events\AddSubmissionEvent;
use App\Models\User;
use App\Notifications\AddSubmissionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class AddSubmissionListener
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
    public function handle(AddSubmissionEvent $event): void
    {

        Notification::send(
            User::find($event->classwork->user_id),
            new AddSubmissionNotification($event->classwork),
        );
        // dd($event->classwork->user_id);
    }
}
