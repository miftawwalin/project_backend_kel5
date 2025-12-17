<?php

namespace App\Http\Controllers;

use App\Models\ProductRequest;
use Illuminate\Http\Request;

class InventoryMovementController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductRequest::with(['user', 'items.product', 'department'])
            ->whereIn('status', ['approved', 'rejected']);

        // Filter by Date (Tanggal Pengambilan / Request Date)
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('request_date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('request_date', '<=', $request->end_date);
        }

        // Search by NPK/Name if needed (optional but good)
        if ($request->has('search') && $request->search) {
            $query->where('npk_nama', 'like', '%' . $request->search . '%');
        }

        $movements = $query->latest('updated_at')->paginate(10);

        return view('pages.inventory-movements', compact('movements'));
    }
}
