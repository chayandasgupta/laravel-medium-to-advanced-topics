<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\TestingNotification;
use App\Notifications\OfferNotification;
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
        //$user->notify( new TestingNotification($notificationData) );
        
        // notification send use notification facade
        Notification::send($user, new TestingNotification($notificationData));
        return redirect('/');
    }


    public function sendOfferNotification()
    {
        $user = User::first();

        $offerData = [
            'name' => 'BOGO',
            'body' => 'You received an offer.',
            'thanks' => 'Thank you',
            'offerText' => 'Check out the offer',
            'offerUrl' => url('/'),
            'offer_id' => 007
        ];

        Notification::send($user, new OfferNotification($offerData));
        dd('Task completed');
    }
}
