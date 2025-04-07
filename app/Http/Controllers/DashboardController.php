<?php

namespace App\Http\Controllers;

use App\Models\Production;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function admin(Request $request)
    {
        $bulan = $request->input('bulan'); // format: yyyy-mm

        $productions = Production::with('reportApproval.approval');

        if ($bulan) {
            $productions->whereMonth('date_production', substr($bulan, 5, 2))
                ->whereYear('date_production', substr($bulan, 0, 4));
        }

        $productions = $productions->get();

        $groupBy = $productions->groupBy(function ($item) {
            return optional($item->reportApproval->approval)->name;
        });

        $results = $groupBy->map(function ($group) {
            $totalAchievement = round($group->sum('achievement'));
            $firstItem = $group->first();
            return [
                'leader_id' => $firstItem->reportApproval->approval_id,
                'name' => optional($firstItem->reportApproval->approval)->name,
                'target' => $firstItem->target,
                'actual' => $totalAchievement,
            ];
        })->values()->toArray();

        $dataProductionsAll = Production::with('reportApproval')
            ->when($bulan, function ($query, $bulan) {
                return $query->whereRaw("DATE_FORMAT(date_production, '%Y-%m') = ?", [$bulan]);
            })
            ->get();

        return view('dashboard.dashboardadmin', compact('results', 'bulan', 'dataProductionsAll'));
    }

}
