<?php

namespace App\Notifications;

use App\Models\Classwork;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class NewClassworkNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public Classwork $classwork;

    public function __construct(Classwork $classwork)
    {
        $this->classwork=$classwork;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable /* notifiable used to get information for user that receive notification */): array 
    {
        // channels names in laravel ==>  mail , database , broadcast (pusher) , vonage(sms) , slack 
        // mail email
        // database store data in database
        // broadcast real time notification

        // if($notifiable->receive_mail_notifications){
        //     $via[]="mail";
        // }

   
        return ["mail","database","broadcast"]; // channels name
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("New classwork")
                    ->greeting("Hello ".$notifiable->name)
                    ->line('There is new work from type '.$this->classwork->types)
                    ->action('To transformation into classwork page click on button', route("classrooms.classworks.show",[$this->classwork->classroom,$this->classwork]))
                    ->line('Good luck');
                    // return view ("view name",[]);
    }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        // the array will stored in data column in notificatios table
        return new DatabaseMessage([
                "title"=>"new classwork",
                "body"=>"There is new work from type ".$this->classwork->types,
        ]);
                    
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        // the array will stored in data column in notificatios table
        return new BroadcastMessage([
                "title"=>"new classwork",
                "body"=>"There is new work from type ".$this->classwork->types,
        ]);
                    
    }

    // public function toVonage(object $notifiable): VonageMessage{
    //     return (new VonageMessage)->content("new classwork ".$this->classwork->types);
    // }


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
