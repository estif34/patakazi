<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jobs = auth()->user()->jobs()
            // ->withCount('applications')  // We'll add this relationship later
            ->latest()
            ->paginate(10);

        $stats = [
            'total_jobs' => auth()->user()->jobs()->count(),
            'active_jobs' => auth()->user()->jobs()->where('status', 'active')->count(),
            'inactive_jobs' => auth()->user()->jobs()->where('status', 'inactive')->count(),
        ];

        return view('dashboard.index', compact('jobs', 'stats'));
    }
}
