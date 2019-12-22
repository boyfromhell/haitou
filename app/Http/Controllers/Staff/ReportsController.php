<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\ReportsRequest;
use App\Models\Report;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $reports = Report::select('id', 'name', 'report_type', 'is_solved')->orderBy('id', 'DESC')->get();
        $total = Report::count();
        $resolve = Report::where('is_solved', '=', true)->count();
        $pending = Report::where('is_solved', '=', false)->count();

        return view('staff.reports.index', compact('reports', 'total', 'resolve', 'pending'));
    }

    public function show($report_id)
    {
        $report = Report::findOrFail($report_id);
        return view('staff.reports.report', compact('report'));
    }

    public function update(ReportsRequest $request, $report_id)
    {
        $report = Report::findOrFail($report_id);
        $report->staff_id = auth()->user()->id;
        $report->solution = $request->input('solution');
        $report->is_solved = true;
        $report->update();
        toastr()->info('Report atualizado.', 'Sucesso');
        return redirect()->to('staff/reports');
    }
}
