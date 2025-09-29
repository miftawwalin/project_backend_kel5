<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestModel;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function index()
    {
        $requests = RequestModel::with('items')->latest()->paginate(10);
        return view('requests.index', compact('requests'));
    }

    public function create()
    {
        return view('requests.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'request_date' => 'required|date',
            'produk' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.item_code' => 'nullable|string',
            'items.*.item_name' => 'required|string',
            'items.*.loc' => 'nullable|string',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.uom' => 'nullable|string',
            'items.*.npk_name' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $req = RequestModel::create([
                'request_date' => $data['request_date'],
                'produk' => $data['produk'] ?? null,
                'status' => 'pending',
            ]);

            $req->items()->createMany($data['items']);

            DB::commit();
            return redirect()->route('requests.index')->with('success', 'Request berhasil disimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
$product = Product::where('item_code', $request->item_code)->first();

if (!$product) {
    return response()->json(['error' => 'Item Code not found in database!'], 404);
}
