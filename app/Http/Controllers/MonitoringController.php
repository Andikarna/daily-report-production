<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\MainGroup;
use App\Models\Production;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DailyAchievement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    public function index(Request $request)
    {

        $productions = DailyAchievement::with('production', 'division', 'operator')
            ->orderByDesc('created_at')
            ->get();

        if ($request->filled('month')) {
            $selectedMonth = $request->input('month');

            $productions = $productions->filter(function ($item) use ($selectedMonth) {
                return Carbon::parse($item->date_production)->format('Y-m') === $selectedMonth;
            });
        }

        $grouped = $productions->groupBy(function ($item) {
            return $item->operator_id . '-' . Carbon::parse($item->date_production)->format('Y-m-d');
        });

        $results = $grouped->map(function ($items) {
            $totalAchievement = $items->sum('achievement');
            $averageAchievement = round($items->avg('achievement'), 2);
            $operator = $items->first()->operator;
            $group = MainGroup::where('user_id', $operator->id)->with('group')->first();

            return [
                'production_id' => $items->first()->production->id,
                'division' => $group->group->code ?? "Available",
                'operator_name' => $operator->name,
                'date' => Carbon::parse($items->first()->date_production)->format('Y-m-d'),
                'total_achievement' => $totalAchievement,
                'average_achievement' => $averageAchievement,
            ];
        })->sortBy('date')->values();

        $finalResults = $results->groupBy('operator_name')->map(function ($items, $key) {

            $dates = $items->pluck('date')
                ->map(function ($date) {

                    return Carbon::parse($date)->format('Y-m');
                })
                ->unique();

            $month = $dates->first();

            $workingDays = Carbon::parse($month . '-01')->daysInMonth;
            $workingDays = collect(range(1, $workingDays))
                ->map(function ($day) use ($month) {
                    $date = Carbon::parse($month . '-' . $day);
                    return $date->dayOfWeek !== Carbon::SUNDAY;
                })
                ->filter(function ($isWorkingDay) {
                    return $isWorkingDay;
                })
                ->count();

            $totalAchievement = $items->sum('average_achievement');
            $averageAchievementPerDay = $workingDays > 0 ? round($totalAchievement / $workingDays) : 0;

            return [
                'operator_name' => $key,
                'average_achievement' => round($items->avg('average_achievement'), 2)
            ];
            
        })->values();

        return view('monitoring.monitoring', [
            'results' => $results,
            'finalResults' => $finalResults,
            'bulan' => $request->input('month'),
        ]);
    }

    public function generate($bulan)
    {

        if (!Auth::check()) {
            return redirect('/login');
        }

        $date = Carbon::now();

        $result = DailyAchievement::when($bulan !== '1111-11', function ($query) use ($bulan) {
            return $query->whereRaw("DATE_FORMAT(date_production, '%Y-%m') = ?", [$bulan]);
        })->get();

        $pdf = Pdf::loadView('generate.generateDailyAchievements', ['result' => $result]);

        return $pdf->stream('Report Bulan' . $date . ".pdf");
    }
}
