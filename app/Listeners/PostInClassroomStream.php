<?php

namespace App\Listeners;

use App\Events\ClassworkCreated;
use App\Models\Stream;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostInClassroomStream
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
    public function handle(ClassworkCreated $event): void
    {
        $classwork = $event->classwork;
        $stream=new Stream();
        $stream->classroom_id=$classwork->classroom->id;
        $stream->user_id=$classwork->user_id;
        $stream->content="There is new classwork in ".$classwork->classroom->id;
        $isSaved= $stream->save();
    }
}
