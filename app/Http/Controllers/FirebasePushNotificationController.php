<?php

namespace App\Http\Controllers;

use App\Notifications\SendPushNotification;
use Illuminate\Support\Facades\Notification;

class FirebasePushNotificationController extends Controller
{
    // protected $notification;

    // public function __construct()
    // {
    //     $this->notification = Firebase::messaging();
    // }

    public function notification()
    {
        $fcmToken = 'dN39KIvvCLAASfoZNXg1n8:APA91bHvdKCfRyhHbWgAn-IpeLG0_poWnIgTEttu0OCJpQAKe4VkV0ULBfwCE3GqzgT4nst0jKHicmurpQJ3BihtZ294_MPblYrfpqNlgTR321XW9iRd4ShTi0Z1HOsNEh3cfiEKwl2m';
        $title = 'Subscription';
        $body = 'Thanks for subscribe to our channel!!!';

        // $message = CloudMessage::fromArray([
        //     'token' => $fcmToken,
        //     'notification' => [
        //         'title' => $title,
        //         'body' => $body,
        //     ],
        // ]);

        // $this->notification->send($message);

        $notification = new SendPushNotification();

        Notification::route('fcm', $fcmToken)->notify($notification);

        return response()->json(['message' => 'Notification sent successfully']);

    }
}
