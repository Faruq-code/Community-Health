<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_reports' => Report::count(),
            'pending_reports' => Report::where('status', 'Pending')->count(),
            'resolved_reports' => Report::where('status', 'Resolved')->count(),
            'total_messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
        ];

        $recent_reports = Report::with('user')->latest()->limit(5)->get();
        $recent_messages = ContactMessage::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_reports', 'recent_messages'));
    }
}
