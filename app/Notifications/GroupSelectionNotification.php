<?php

namespace App\Notifications;

use App\Models\Selection;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GroupSelectionNotification extends Notification
{
    use Queueable;

    private $selection;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Selection $selection)
    {
        $this->selection = $selection;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your secret santa group has been drawn!')
            ->greeting('Hello ' . $notifiable->name)
            ->line('You have been entered into the ' . $this->selection->group->name . ' secret group.')
            ->line('We are pleased to inform you that you have drawn ' . $this->selection->member->user->name . '.')
            ->line('But shhhhh, don\'t tell anyone, it\'s a secret!')
            ->salutation('We hope you have a very Merry Christmas and a happy new year!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
