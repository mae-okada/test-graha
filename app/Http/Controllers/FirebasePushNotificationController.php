<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        // $fcmToken = 'dVya0Q01wXqTJImXzhK-_h:APA91bG-1HcJpWzvB04h652zMLLqlM3hkFFxeJhLtUEuOXRDD5sj20L0DxuPVMObSpueAJEdgCUZ93rKyz87UYFB8tXbNNhnDLK_eeBEloNJBrK1um3nY5HME4PeIHTKIA_DD94qXNr2';
        // $title = 'Subscription';
        // $body = 'Thanks for subscribe to our channel!!!';

        // $message = CloudMessage::fromArray([
        //     'token' => $fcmToken,
        //     'notification' => [
        //         'title' => $title,
        //         'body' => $body,
        //     ],
        // ]);

        // $this->notification->send($message);

        $notification = new SendPushNotification();
        // $delay = now()->addMinutes(1);

        // Notification::route('fcm', $fcmToken)->notify($notification);
        // Notification::route('database')->notify($notification);

        $user = User::first();
        $user->notify($notification);

        // Notification::route('fcm', $fcmToken)->notify($notification->delay($delay));

        return response()->json(['message' => 'Notification sent successfully']);

    }
}
