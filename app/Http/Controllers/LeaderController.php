<?php

namespace App\Http\Controllers;

use App\Models\ReportApproval;
use Carbon\Carbon;
use App\Models\Division;
use App\Models\Report_Approval;
use Illuminate\Http\Request;
use App\Models\ReportProduction;
use Illuminate\Support\Facades\Auth;
use App\Models\ReportDetailProduction;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class LeaderController extends Controller
{
    public function leader_view(Request $request)
    {
        $user = Auth::user();
        $reports = ReportProduction::where('leader_id', $user->id)
            ->with('division')
            ->orderByDesc('created_at');

        $divisions = Division::all();

        $filterOperator = $request->get('filter_operator');
        if ($filterOperator) {
            $reports->where('divisi_id', $filterOperator);
        }


        $search = $request->get('search');
        if ($search) {
            $reports->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('date_production', 'LIKE', "%{$search}%")
                    ->orWhere('shift', 'LIKE', "%{$search}%");
            });
        }

        $reports = $reports->paginate(6);

        return view('report_leader.report', compact('reports', 'divisions'));
    }

    public function detail($id)
    {

        $report = ReportProduction::where('id', $id)
            ->with('division')
            ->first();

        $details = ReportDetailProduction::where('report_id', $id)
            ->with('lotDetails')
            ->get();

        //dd($details->lot_detail);

        return view('report_leader.detail', compact('report', 'details'));
    }

    public function update($id)
    {

        $report = ReportProduction::where('id', $id)
            ->with('division')
            ->first();

        $details = ReportDetailProduction::where('report_id', $id)
            ->with('lotDetails')
            ->get();

        return view('report_leader.update', compact('report', 'details'));
    }

    public function approve($id){

        $report = ReportProduction::where('id',$id)->first();
        $report->status = "Sudah Approve";
        $report->updated_at = Carbon::now('Asia/Jakarta');
        $report->save();

        $approval = new ReportApproval();
        $approval->divisi_id = $report->divisi_id;
        $approval->report_id = $report->id;
        $approval->report_detail_id = 0;
        $approval->approval_id = Auth::user()->id;
        $approval->status = "Baru";
        $approval->created_at = Carbon::now('Asia/Jakarta');
        $approval->created_by = Auth::user()->id;
        $approval->save();

        return redirect('/report-apporval');
    }
}
