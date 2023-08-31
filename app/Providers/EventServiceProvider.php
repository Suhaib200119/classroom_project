<?php

namespace App\Providers;

use App\Events\AddSubmissionEvent;
use App\Events\ClassworkCreated;
use App\Events\JoinToClassroomEvent;
use App\Listeners\AddSubmissionListener;
use App\Listeners\JoinToClassroomListener;
use App\Listeners\PostInClassroomStream;
use App\Listeners\SendNotificationToAssigndUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        ClassworkCreated::class=>[
            PostInClassroomStream::class,
            SendNotificationToAssigndUser::class
        ],

        AddSubmissionEvent::class=>[
            AddSubmissionListener::class
        ],
        JoinToClassroomEvent::class=>[
            JoinToClassroomListener::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
      
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
