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

        $results = Analytics::select(
            DB::raw('WEEK(weekly_date) as week'),
            DB::raw('SUM(total) as amount')
        )
            ->whereRaw("MONTH(monthly_date) = $month AND YEAR(monthly_date) = $year")
            ->groupBy('week')
            ->get()
            ->toArray();

        // Add labels to the results
        array_walk($results, function (&$result) {
            static $weekNumber = 1;
            $result['label'] = $weekNumber++;
            unset($result['week']);
        });

        dd($results);

    }

    public function showMonthly()
    {
        dd(Analytics::select(
            DB::raw('SUM(total) as amount'),
            DB::raw("DATE_FORMAT(STR_TO_DATE(monthly_date, '%Y-%m-%d'), '%b') as label")
        )
            ->groupBy('monthly_date')
            ->get()
            ->toArray()
        );
    }
}
