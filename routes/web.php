<?php

use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\FirebasePushNotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/analytics', function () {
//     return dd('This is analytics page.');
// });

Route::controller(AnalyticController::class)
    ->prefix('/analytics')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/weekly', 'showWeekly');
        Route::get('/monthly/{year?}', 'showMonthly');
        Route::get('/all-month', 'showMonthlyAll');
    });

Route::get('/notification', [FirebasePushNotificationController::class, 'notification']);
