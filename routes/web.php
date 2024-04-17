<?php

use App\Http\Controllers\AnalyticController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/analytics', function () {
//     return dd('This is analytics page.');
// });

Route::controller(AnalyticController::class)->group(function () {
    Route::get('/analytics', 'index');
    Route::get('/analytics/weekly', 'showWeekly');
    Route::get('/analytics/monthly', 'showMonthly');
});
