<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $reports = $user->reports()->latest()->limit(5)->get();
        
        $stats = [
            'total' => $user->reports()->count(),
            'pending' => $user->reports()->where('status', 'Pending')->count(),
            'resolved' => $user->reports()->where('status', 'Resolved')->count(),
            'in_progress' => $user->reports()->where('status', 'In Progress')->count(),
        ];

        return view('user.dashboard', compact('reports', 'stats'));
    }
}
