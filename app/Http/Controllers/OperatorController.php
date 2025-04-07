<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Division;
use App\Models\MasterProductEnginering;
use Illuminate\Http\Request;
use App\Models\ReportDetailLot;
use App\Models\ReportProduction;
use App\Models\ReportDetailProduction;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    public function operator_view()
    {

        $leader = User::where('role_id', 6)->get();
        $operator = User::where('role_id', 4)->get();
        $noIp = MasterProductEnginering::select('id', 'ip')
            ->get()
            ->unique('ip')
            ->pluck('ip');

        $division = Division::all();

        return view('operator_production.addProduction', compact('leader', 'division', 'operator','noIp'));
    }


    public function save_report(Request $request)
    {
        //dd($request);
        //report
        $newReport = new ReportProduction();
        $newReport->divisi_id = $request->division;
        $newReport->leader_id = $request->leader;
        $newReport->date_production =  $request->date_production;
        $newReport->operator_id = $request->name;
        $newReport->name = User::where('id', $request->name)->first()->name;
        $newReport->shift =  $request->shift;
        $newReport->status = "Belum Approve";
        $newReport->created_at = Carbon::now('Asia/Jakarta');
        $newReport->save();

        //reportdetail
        $reportDetail = [];
        $reportIp = $request->input('ip');
        $countLot = $request->input('countIp');
        $countIp = count($reportIp);

        for ($i = 0; $i < $countIp; $i++) {
            $reportDetail[] = [
                'id' => 0,
                'ip' => $reportIp[$i],
                'count_lot' => $countLot[$i]
            ];
        };

        $lastIndex = 0;
        if ($reportDetail != null) {

            foreach ($reportDetail as $data) {
                $newDetail = new ReportDetailProduction();
                $newDetail->report_id = $newReport->id;
                $newDetail->ip = $data['ip'];
                $newDetail->created_at = Carbon::now('Asia/Jakarta');
                $newDetail->save();
            
                //lot
                $no_lot = $request->input('no_lot');
                $ok_lot = $request->input('ok');
                $ng_lot = $request->input('ng');
                $time_lot = $request->input('time');
                $total_lot = $request->input('total');
                $description_lot = $request->input('description');
            
                $detailLot = [];
                $count_lots = count($no_lot);
            
                // Filter detail lot berdasarkan `report_detail_id`
                for ($i = $lastIndex; $i < $lastIndex + $data['count_lot']; $i++) {
                    if ($i < $count_lots) {
                        $detailLot[] = [
                            'id' => 0,
                            'no_lot' => $no_lot[$i],
                            'ok' => $ok_lot[$i],
                            'ng' => $ng_lot[$i],
                            'time' => $time_lot[$i],
                            'total' => $total_lot[$i],
                            'description' => $description_lot[$i],
                        ];
                    }
                }
            
                $lastIndex += $data['count_lot'];
            
                if (!empty($detailLot)) {
                    foreach ($detailLot as $datalot) {
                        $newLot = new ReportDetailLot();
                        $newLot->report_id = $newReport->id;
                        $newLot->report_detail_id = $newDetail->id;
                        $newLot->no_lot = $datalot['no_lot'];
                        $newLot->ok = $datalot['ok'];
                        $newLot->ng = $datalot['ng'];
                        $newLot->time = $datalot['time'];
                        $newLot->total = $datalot['total'];
                        $newLot->description = $datalot['description'];
                        $newLot->created_at = Carbon::now('Asia/Jakarta');
                        $newLot->save();
                    }
                }
            }
            
        }


        return redirect('/production/operator-produksi');
    }
}
