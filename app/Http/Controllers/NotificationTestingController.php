<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\TestingNotification;
use Illuminate\Support\Facades\Notification;

class NotificationTestingController extends Controller
{
    public function sendNotification()
    {           
        $user = User::first();

        $notificationData = [
            'body' => 'You received a new test notification',
            'notificationText' => 'You are allwoed to enroll',
            'url' => url('/'),
            'thankyou' => 'You have 14 days to enroll'
        ];

        //first rule/first via
        $user->notify( new TestingNotification($notificationData) );
        
        // notification send use notification facade
        Notification::send($user, new TestingNotification($notificationData));
        return redirect('/');
    }
}
