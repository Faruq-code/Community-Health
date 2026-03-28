<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = auth()->user()->reports()->latest()->paginate(10);
        return view('user.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('user.reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:200',
            'category'    => 'required|in:Bug,Feature Request,Infrastructure,Security,Other',
            'priority'    => 'required|in:Low,Medium,High,Critical',
            'description' => 'required|string|min:20|max:5000',
        ]);

        auth()->user()->reports()->create($validated);
        return redirect()->route('user.reports.index')->with('success', 'Report submitted successfully.');
    }

    public function show(Report $report)
    {
        abort_if($report->user_id !== auth()->id(), 403);
        return view('user.reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        abort_if($report->user_id !== auth()->id() || $report->status !== 'Pending', 403);
        return view('user.reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        abort_if($report->user_id !== auth()->id() || $report->status !== 'Pending', 403);

        $validated = $request->validate([
            'title'       => 'required|string|max:200',
            'category'    => 'required|in:Bug,Feature Request,Infrastructure,Security,Other',
            'priority'    => 'required|in:Low,Medium,High,Critical',
            'description' => 'required|string|min:20|max:5000',
        ]);

        $report->update($validated);
        return redirect()->route('user.reports.show', $report)->with('success', 'Report updated successfully.');
    }

    public function destroy(Report $report)
    {
        abort_if($report->user_id !== auth()->id() || $report->status !== 'Pending', 403);

        $report->delete();
        return redirect()->route('user.reports.index')->with('success', 'Report deleted successfully.');
    }
}
