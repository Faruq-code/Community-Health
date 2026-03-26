<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('user')->latest()->paginate(20);
        return view('admin.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        return view('admin.reports.show', compact('report'));
    }

    public function updateStatus(Request $request, Report $report)
    {
        $request->validate(['status' => 'required|in:Pending,In Progress,Resolved']);
        $report->update(['status' => $request->status]);
        return back()->with('success', 'Status updated.');
    }

    public function respond(Request $request, Report $report)
    {
        $request->validate(['admin_response' => 'required|string|min:5|max:3000']);
        $report->update([
            'admin_response' => $request->admin_response,
            'responded_at'   => now(),
            'status'         => 'Resolved',
        ]);
        return back()->with('success', 'Response sent to user.');
    }
}
