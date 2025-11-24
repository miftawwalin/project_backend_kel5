<?php

namespace App\Http\Controllers;

use App\Models\ProductRequest;
use Illuminate\Http\Request;

class RequestHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductRequest::with(['user','product']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->from_date && $request->to_date) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        return view('history.index', [
            'requests' => $query->latest()->paginate(10)
        ]);
    }
}
