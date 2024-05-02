<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Channels\DatabaseChannel;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

// class SendPushNotification extends Notification
class SendPushNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable)
    {
        return [
            FcmChannel::class,
            DatabaseChannel::class,
        ];
    }

    public function toFcm($notifiable): FcmMessage
    {
        return new FcmMessage(notification: new FcmNotification(
            title: 'Hello World',
            body: 'This message is sent by Mae',
            image: 'https://en.wikipedia.org/wiki/File:Hello_kitty_character_portrait.png',
        ));
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Hello World',
            'body' => 'This message is sent by Mae',
            'image' => 'https://en.wikipedia.org/wiki/File:Hello_kitty_character_portrait.png',
        ];
    }
}
