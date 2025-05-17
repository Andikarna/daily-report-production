<?php

namespace App\Http\Controllers;

use App\Models\DailyAchievement;
use Carbon\Carbon;
use App\Models\Division;
use App\Models\Production;
use Illuminate\Http\Request;
use App\Models\MasterProduct;
use App\Models\ReportApproval;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ReportProduction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ReportDetailProduction;
use App\Models\MasterProductEnginering;

class ProductionController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $reports = ReportApproval::with('division', 'report', 'approval')
            ->orderByDesc('created_at');

        $search = $request->get('search');
        if ($search) {
            $reports->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('date_production', 'LIKE', "%{$search}%")
                    ->orWhere('shift', 'LIKE', "%{$search}%");
            });
        }

        $reports = $reports->paginate(6);

        return view('admin.production', compact('reports'));
    }

    public function update($id)
    {
        $production = ReportApproval::with('division', 'report', 'approval')->find($id);

        $reportDetail = ReportDetailProduction::where('report_id', $production->report_id)->get();

        return view('admin.updateProduction', compact('production', 'reportDetail',));
    }

    public function reject(Request $request, $id)
    {
        $reportApproval = ReportApproval::where('id', $id)->first();
        $reportProduction = ReportProduction::where('id', $reportApproval->report_id)->first();

        $reportApproval->status = "Reject";
        $reportApproval->updated_at = Carbon::now('Asia/Jakarta');
        $reportApproval->save();

        return redirect('/production');
    }

    public function create(Request $request, $id)
    {
        //dd($request);
        $reportApproval = ReportApproval::where('id', $id)->first();
        $reportProduction = ReportProduction::where('id', $reportApproval->report_id)->first();

        $productions = [];
        $production_ip = $request->input('ip');
        $production_goal = $request->input('goal');
        $production_time = $request->input('time');
        $production_standart  = $request->input('standart');
        $production_ok  = $request->input('ok');
        $production_percentok  = $request->input('percentok');
        $production_ng = $request->input('ng');
        $production_percentng = $request->input('percentng');
        $production_total = $request->input('total');
        $production_achievement = $request->input('achievement');

        $countProducution = count($production_ip);

        for ($i = 0; $i < $countProducution; $i++) {
            $productions[] = [
                'ip' => $production_ip[$i],
                'goal' => $production_goal[$i],
                'time' => $production_time[$i],
                'standart' => $production_standart[$i],
                'ok' => $production_ok[$i],
                'percentok' => $production_percentok[$i],
                'ng' => $production_ng[$i],
                'percentng' => $production_percentng[$i],
                'total' => $production_total[$i],
                'achievement' => $production_achievement[$i]
            ];
        };

        if ($productions != null) {

            foreach ($productions as $data) {

                $newProduction = new Production();
                $newProduction->report_approval_id = $id;
                $newProduction->date_production = $reportProduction->date_production;
                $newProduction->ip = $data['ip'];
                $newProduction->target =  $data['goal'];
                $newProduction->time =  $data['time'];
                $newProduction->standart =  $data['standart'];
                $newProduction->ok =  $data['ok'];
                $newProduction->percent_of_ok =  $data['percentok'];
                $newProduction->ng =  $data['ng'];
                $newProduction->percent_of_ng =  $data['percentng'];
                $newProduction->total =  $data['total'];
                $newProduction->achievement =  $data['achievement'];
                //$newProduction->description =  $data['name'];
                $newProduction->created_at = Carbon::now('Asia/Jakarta');
                $newProduction->created_by = Auth::user()->name;
                $newProduction->created_byId = Auth::user()->id;
                $newProduction->save();

                $newDailyAchievement = new DailyAchievement();
                $newDailyAchievement->production_id = $newProduction->id;
                $newDailyAchievement->divisi_id = $reportApproval->divisi_id;
                $newDailyAchievement->operator_id = $reportProduction->operator_id;
                $newDailyAchievement->date_production = $reportProduction->date_production;
                $newDailyAchievement->achievement = $data['achievement'];
                $newDailyAchievement->created_at = Carbon::now('Asia/Jakarta');
                $newDailyAchievement->save();
            }
        }

        

        $reportApproval->status = "Approve";
        $reportApproval->updated_at = Carbon::now('Asia/Jakarta');
        $reportApproval->save();

        return redirect('/production');
    }

    public function reportMonthly(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // $data = Production::with('reportApproval')
        //     ->orderByDesc('created_at');

        $divisiId = $request->get('divisi');
        $bulan = $request->get('bulan') ?? now()->format('Y-m');

        $data = Production::with('reportApproval')
            ->when($divisiId, function ($query) use ($divisiId) {
                $query->whereHas('reportApproval.division', function ($subQuery) use ($divisiId) {
                    $subQuery->where('id', $divisiId);
                });
            })
            ->when($bulan, function ($query) use ($bulan) {
                [$tahun, $bln] = explode('-', $bulan);
                $query->whereYear('date_production', $tahun)
                    ->whereMonth('date_production', $bln);
            })
            ->orderByDesc('created_at');

        $search = $request->get('search');
        if ($search) {
            $data->where(function ($q) use ($search) {
                $q->where('ip', 'LIKE', "%{$search}%")
                    ->orWhere('achievement', 'LIKE', "%{$search}%")
                    ->orWhereHas('reportApproval', function ($query) use ($search) {
                        $query->whereHas('division', function ($subQuery) use ($search) {
                            $subQuery->where('name', 'LIKE', "%{$search}%");
                        })
                            ->orWhereHas('approval', function ($subQuery) use ($search) {
                                $subQuery->where('name', 'LIKE', "%{$search}%");
                            });
                    })
                    ->orWhereRaw("DATE_FORMAT(date_production, '%W, %d %M %Y') LIKE ?", ["%{$search}%"]);
            });
        };

        $produksi = $data->paginate(6)->appends($request->query());

        $division = Division::all();


        return view('report_monthly.reportMonthly', compact('produksi', 'division', 'bulan'));
    }

    public function generate($bulan)
    {

        if (!Auth::check()) {
            return redirect('/login');
        }

        //dd($bulan);

        $date = Carbon::now();
        $data = Production::whereRaw("DATE_FORMAT(date_production, '%Y-%m') = ?", [$bulan])->get();

        $pdf = Pdf::loadView('generate.generateReport', ['data' => $data]);

        return $pdf->stream('Report Bulan' . $date . ".pdf");
    }
}
