<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class AnalyticController extends Controller
{
    public function index()
    {
        $analytics = Analytics::query()->get()->toArray();
        dd($analytics);
    }

    public function showMonthlyAll()
    {
        $monthlyDatas = Analytics::selectRaw('monthly_date as label')
            ->selectRaw('SUM(total) as amount')
            ->groupBy('monthly_date')
            ->get()
            ->map(function ($monthlyData) {
                $monthlyData->label = Carbon::parse($monthlyData->label)->format('M Y');

                return $monthlyData;
            });

        return JsonResource::collection($monthlyDatas);
    }

    public function showMonthly(int $year = 2024)
    {
        // $year = 2024;

        $monthlyDatas = Analytics::selectRaw('monthly_date as label')
            ->selectRaw('SUM(total) as amount')
            ->whereYear('monthly_date', $year)
            ->groupBy('monthly_date')
            ->get()
            ->map(function ($monthlyData) {
                $monthlyData->label = Carbon::parse($monthlyData->label)->format('M');

                return $monthlyData;
            });

        return JsonResource::collection($monthlyDatas);
    }

    public function showWeekly()
    {
        $year = 2024;
        $month = 2;

        $weeklyAnalytics = Analytics::selectRaw('weekly_date')
            ->selectRaw('SUM(total) as amount')
            ->whereYear('monthly_date', $year)
            ->whereMonth('monthly_date', $month)
            ->groupBy('weekly_date')
            ->get()
            ->map(function ($analytic) use ($year, $month) {
                $weeklyDate = Carbon::parse($analytic->label);
                $startDate = Carbon::create($year, $month, 1);

                return [
                    // 'month' => $weeklyDate->format('M'),
                    // 'differenceInWeek' => $weeklyDate->diffInWeeks($startDate),
                    'label' => 1 + (int) ($weeklyDate->diffInWeeks($startDate) * (-1)),
                    'amount' => $analytic->amount,
                ];
            });

        return JsonResource::collection($weeklyAnalytics);
    }
}
