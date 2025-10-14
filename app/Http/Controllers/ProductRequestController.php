<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductRequest;

class ProductRequestController extends Controller
{
    /**
     * Halaman daftar request untuk user
     */
    public function userIndex()
    {
        $user = auth()->user();
        $karyawan = $user->karyawan;

        $products = Product::all();
        $requests = ProductRequest::with('product')
            ->when($karyawan, function ($query) use ($karyawan) {
                $query->where('karyawan_id', $karyawan->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.form-request-user', compact('products', 'requests'));
    }

    /**
     * Simpan permintaan barang dari user/admin
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'note' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();
        $karyawan = $user->karyawan;

        ProductRequest::create([
            'product_id'    => $request->product_id,
            'karyawan_id'   => $karyawan?->id,
            'department_id' => $karyawan?->department_id,
            'qty'           => $request->qty,
            'note'          => $request->note,
            'status'        => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Permintaan barang berhasil dikirim.');
    }

    /**
     * Daftar semua request (khusus admin)
     */
    public function index()
    {
        $requests = ProductRequest::with(['product', 'karyawan.department'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.requests.index', compact('requests'));
    }

    /**
     * Setujui permintaan barang
     */
    public function approve($id)
    {
        $req = ProductRequest::findOrFail($id);
        $product = $req->product;

        if ($product->qty >= $req->qty) {
            $product->qty -= $req->qty;
            $product->save();

            $req->update(['status' => 'Approved']);
            return back()->with('success', 'Permintaan disetujui dan stok diperbarui.');
        }

        return back()->with('error', 'Stok tidak mencukupi!');
    }

    /**
     * Tolak permintaan barang
     */
    public function reject($id)
    {
        ProductRequest::findOrFail($id)->update(['status' => 'Rejected']);
        return back()->with('error', 'Permintaan ditolak.');
    }

    /**
     * Dashboard user (perbaikan utama)
     */
    public function userDashboard()
    {
        $user = auth()->user();
        $karyawan = $user->karyawan;

        $requests = ProductRequest::with('product')
            ->when($karyawan, function ($query) use ($karyawan) {
                $query->where('karyawan_id', $karyawan->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $total = $requests->count();
        $approved = $requests->where('status', 'Approved')->count();
        $pending = $requests->where('status', 'Pending')->count();
        $rejected = $requests->where('status', 'Rejected')->count();

        return view('pages.dashboard', compact('requests', 'total', 'approved', 'pending', 'rejected'));
    }

    /**
     * Form request user (agar admin juga bisa akses form yang sama)
     */
    public function create()
    {
        $products = Product::all();
        $user = auth()->user();
        $karyawan = $user->karyawan;

        $requests = ProductRequest::with('product')
            ->when($karyawan, function ($query) use ($karyawan) {
                $query->where('karyawan_id', $karyawan->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.form-request-user', compact('products', 'requests'));
    }
}
