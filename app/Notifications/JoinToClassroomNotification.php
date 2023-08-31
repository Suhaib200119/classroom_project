<?php

namespace App\Notifications;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class JoinToClassroomNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Classroom $classroom,public User $user)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ["database","broadcast","mail","vonage"];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("Join To Classroom")
                    ->greeting("Hello ".$notifiable->name)
                    ->line('There is new student joined into your classroom '.$this->classroom->name)
                    ->line($this->user->name." joined into ".$this->classroom->name." classroom");
    }

    public function toDatabase(object $notifiable):DatabaseMessage{
        return new DatabaseMessage(
            [
                "title"=>"new join to your classroom",
                "body"=>"the ".$this->user->name." joined into ".$this->classroom->name." classroom",
            ]
        );
    }

    public function toBroadcast(object $notifiable): BroadcastMessage{
        return new BroadcastMessage( 
            [
            "title"=>"new join to your classroom",
            "body"=>"the ".$this->user->name." joined into ".$this->classroom->name." classroom",
        ]
    );
    }

    public function toVonage(object $notifiable): VonageMessage{
        $vonage=new VonageMessage();
        $vonage->content("Hello ".$notifiable->name." ,The ".$this->user->name." joined into ".$this->classroom->name." classroom");
        return $vonage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
