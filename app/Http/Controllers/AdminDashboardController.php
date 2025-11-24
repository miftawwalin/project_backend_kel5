<?php

namespace App\Http\Controllers;

use App\Models\ProductRequest;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalRequests'     => ProductRequest::count(),
            'pendingRequests'   => ProductRequest::where('status', 'pending')->count(),
            'approvedRequests'  => ProductRequest::where('status', 'approved')->count(),
            'rejectedRequests'  => ProductRequest::where('status', 'rejected')->count(),
            'latestRequests'    => ProductRequest::with(['user', 'product'])
                                    ->latest()
                                    ->take(10)
                                    ->get(),
        ]);
    }
}
