<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use Illuminate\Support\Facades\DB;

class AnalyticController extends Controller
{
    public function index()
    {
        $analytics = Analytics::query()->get()->toArray();
        dd($analytics);
    }

    public function showWeekly()
    {
        $year = 2023;
        $month = 7;

        $weeklyAnalytics = Analytics::select(
            DB::raw('WEEK(weekly_date) as week'),
            DB::raw('SUM(total) as amount')
        )
            ->whereYear('monthly_date', $year)
            ->whereMonth('monthly_date', $month)
            ->groupBy('week')
            ->get()
            ->toArray();

        // Add labels to the weeklyAnalytics
        array_walk($weeklyAnalytics, function (&$weeklyAnalytic) {
            static $weekNumber = 1;
            $weeklyAnalytic['label'] = $weekNumber++;
            unset($weeklyAnalytic['week']);
        });

        dd($weeklyAnalytics);

    }

    public function showMonthly()
    {
        $year = 2024;

        dd(Analytics::selectRaw("DATE_FORMAT(monthly_date, '%b') as label")
            ->selectRaw('SUM(total) as amount')
            ->whereYear('monthly_date', $year)
            ->groupBy('monthly_date')
            ->get()
            ->toArray()
        );
    }
}
