<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalUsers = User::count();
        $approvedUsers = User::where('is_approved', true)->count();
        $pendingUsers = User::where('is_approved', false)->count();
        
        $recentUsers = User::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalUsers', 'approvedUsers', 'pendingUsers', 'recentUsers'));
    }
}
