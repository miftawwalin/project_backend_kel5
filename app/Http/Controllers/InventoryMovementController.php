<?php

namespace App\Http\Controllers;

use App\Models\ProductRequest;
use App\Models\ProductRequestItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function edit($id)
    {
        $movement = ProductRequest::with(['items.product', 'user', 'department'])->findOrFail($id);
        return view('pages.edit-movement', compact('movement'));
    }

    public function update(Request $request, $id)
    {
        $movement = ProductRequest::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'note' => 'nullable|string|max:255',
        ]);

        $movement->update([
            'status' => $request->status,
            'note' => $request->note ?? $movement->note,
            'approved_at' => $request->status === 'approved' ? now() : null,
        ]);

        return redirect()->route('inventory-movements')->with('success', 'Movement berhasil diupdate');
    }

    public function destroy($id)
    {
        $movement = ProductRequest::findOrFail($id);
        
        DB::transaction(function () use ($movement) {
            // Kembalikan stock jika approved
            if ($movement->status === 'approved') {
                foreach ($movement->items as $item) {
                    $product = $item->product;
                    if ($product) {
                        $product->qty += $item->qty;
                        $product->save();
                    }
                }
            }
            
            // Hapus items terlebih dahulu (cascade)
            $movement->items()->delete();
            // Hapus movement
            $movement->delete();
        });

        return redirect()->route('inventory-movements')->with('success', 'Movement berhasil dihapus');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return back()->with('error', 'Tidak ada item yang dipilih');
        }

        $movements = ProductRequest::whereIn('id', $ids)->get();
        
        DB::transaction(function () use ($movements) {
            foreach ($movements as $movement) {
                // Kembalikan stock jika approved
                if ($movement->status === 'approved') {
                    foreach ($movement->items as $item) {
                        $product = $item->product;
                        if ($product) {
                            $product->qty += $item->qty;
                            $product->save();
                        }
                    }
                }
                
                // Hapus items
                $movement->items()->delete();
                // Hapus movement
                $movement->delete();
            }
        });

        return back()->with('success', count($ids) . ' movement(s) berhasil dihapus');
    }

    public function destroyAll(Request $request)
    {
        $query = ProductRequest::whereIn('status', ['approved', 'rejected']);

        // Apply same filters as index
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('request_date', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('request_date', '<=', $request->end_date);
        }
        if ($request->has('search') && $request->search) {
            $query->where('npk_nama', 'like', '%' . $request->search . '%');
        }

        $movements = $query->get();
        $count = $movements->count();

        DB::transaction(function () use ($movements) {
            foreach ($movements as $movement) {
                // Kembalikan stock jika approved
                if ($movement->status === 'approved') {
                    foreach ($movement->items as $item) {
                        $product = $item->product;
                        if ($product) {
                            $product->qty += $item->qty;
                            $product->save();
                        }
                    }
                }
                
                // Hapus items
                $movement->items()->delete();
                // Hapus movement
                $movement->delete();
            }
        });

        return back()->with('success', $count . ' movement(s) berhasil dihapus');
    }
}
