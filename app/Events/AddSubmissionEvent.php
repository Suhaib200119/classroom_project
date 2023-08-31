<?php

namespace App\Events;

use App\Models\Classwork;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddSubmissionEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public Classwork $classwork;
    public User  $user;
    public function __construct(Classwork $classwork,User  $user)
    {
        $this->classwork=$classwork;
        $this->user=$user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('add-submission.'.$this->classwork->user_id),
        ];
    }

    // public function broadcastAs(){
    //     return "add-submission-in-classwork- {".$this->classwork->id." }";
    // }
}
