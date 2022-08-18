<?php

use App\Jobs\StoreUserJob;
use App\Jobs\WelcomeEmailJob;
use App\Mail\SendWelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test-notification', [App\Http\Controllers\NotificationTestingController::class, 'sendNotification']);
Route::get('offer-notification', [App\Http\Controllers\NotificationTestingController::class, 'sendOfferNotification']);
Route::get('queue-mail', function() {
    // Mail send without use queue. So, its take huge time for send mail
    // Mail::to('chayandas285178@gmail.com')->send( new SendWelcomeEmail() );

    // Mail send use queue but without add jobs
    // dispatch( function() {
    //     Mail::to('chayandas285178@gmail.com')->send( new SendWelcomeEmail() );
    // });

    // Mail send useing queue with delay time 
    // dispatch( function() {
    //     Mail::to('chayandas285178@gmail.com')
    //     ->send( new SendWelcomeEmail() );
    // })->delay(now()->addseconds(5));

    // echo "Mail Sent";

    // Mail send using queue with jobs and delay time
    dispatch( new WelcomeEmailJob() )->delay(now()->addseconds(5));

    // Now we can store big amount of data in database use queue and job
    dispatch ( new StoreUserJob() );

    echo "mail send & data store successfully";
});
