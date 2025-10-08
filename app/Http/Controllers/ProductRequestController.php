<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRequestController extends Controller
{
    // ✅ FORM BUAT USER REQUEST
    public function create()
    {
        $products = Product::all();
        $requests = ProductRequest::with('product')
            ->where('user_id', Auth::id())
            ->latest()->get();

        return view('requests.create', compact('products', 'requests'));
    }

    // ✅ SIMPAN REQUEST USER
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($request->product_id);
        $user = Auth::user();

        if ($request->quantity > $product->qty) {
            return back()->with('error', '❌ Stok tidak mencukupi (maks: ' . $product->qty . ')');
        }

        ProductRequest::create([
            'user_id' => $user->id,
            'department_id' => $user->department_id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'note' => $request->note,
        ]);

        return back()->with('success', '✅ Permintaan berhasil dikirim!');
    }

    // ✅ HALAMAN USER MELIHAT REQUEST MILIKNYA
    public function userIndex()
    {
        $requests = ProductRequest::with('product')
            ->where('user_id', Auth::id())
            ->latest()->get();

        return view('requests.user_index', compact('requests'));
    }

    // ✅ HALAMAN ADMIN MELIHAT SEMUA REQUEST
    public function index()
    {
        $requests = ProductRequest::with(['user', 'department', 'product'])
            ->latest()->get();

        return view('requests.index', compact('requests'));
    }

    // ✅ ADMIN MENYETUJUI REQUEST
    public function approve($id)
    {
        $req = ProductRequest::findOrFail($id);
        $product = $req->product;

        if ($req->quantity > $product->qty) {
            return back()->with('error', '❌ Stok tidak cukup untuk disetujui.');
        }

        $product->decrement('qty', $req->quantity);
        $req->update(['status' => 'approved']);

        return back()->with('success', '✅ Request disetujui & stok dikurangi.');
    }

    // ✅ ADMIN MENOLAK REQUEST
    public function reject($id)
    {
        $req = ProductRequest::findOrFail($id);
        $req->update(['status' => 'rejected']);

        return back()->with('success', '❌ Request ditolak.');
    }
}
