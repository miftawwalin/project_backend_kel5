<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRequestController extends Controller
{
    /**
     * 🧾 Form Request Barang untuk User
     */
    public function create()
    {
        // Ambil semua produk yang tersedia
        $products = Product::orderBy('name', 'asc')->get();

        // Ambil daftar request milik user login
        $requests = ProductRequest::with(['product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('requests.create', compact('products', 'requests'));
    }

    /**
     * 💾 Simpan Permintaan Barang oleh User
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'note'       => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $user = Auth::user();

        // 🔒 Validasi stok cukup
        if ($validated['quantity'] > $product->qty) {
            return back()->with('error', '❌ Stok tidak mencukupi! Stok tersedia hanya ' . $product->qty . '.');
        }

        // 📝 Simpan ke tabel product_requests
        ProductRequest::create([
            'user_id'       => $user->id,
            'department_id' => $user->department_id ?? null, // handle jika user tanpa departemen
            'product_id'    => $product->id,
            'quantity'      => $validated['quantity'],
            'note'          => $validated['note'] ?? '-',
            'status'        => 'pending',
        ]);

        return back()->with('success', '✅ Permintaan berhasil dikirim dan menunggu persetujuan admin.');
    }

    /**
     * 📋 Daftar Request milik User
     */
    public function userIndex()
    {
        $requests = ProductRequest::with(['product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('requests.user_index', compact('requests'));
    }

    /**
     * 🧭 Dashboard User: Menampilkan Ringkasan
     */
    public function userDashboard()
    {
        $user = auth()->user();

        // Ambil request terakhir user
        $requests = ProductRequest::with('product')
            ->where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        // Hitung statistik request user
        $totalRequests    = ProductRequest::where('user_id', $user->id)->count();
        $pendingRequests  = ProductRequest::where('user_id', $user->id)->where('status', 'pending')->count();
        $approvedRequests = ProductRequest::where('user_id', $user->id)->where('status', 'approved')->count();
        $rejectedRequests = ProductRequest::where('user_id', $user->id)->where('status', 'rejected')->count();

        return view('user.dashboard', compact(
            'requests',
            'totalRequests',
            'pendingRequests',
            'approvedRequests',
            'rejectedRequests'
        ));
    }

    /**
     * 👨‍💼 Daftar Semua Request (Admin)
     */
    public function index()
    {
        // Admin melihat semua request user dengan relasi lengkap
        $requests = ProductRequest::with(['user', 'department', 'product'])
            ->latest()
            ->get();

        return view('requests.index', compact('requests'));
    }

    /**
     * ✅ Admin Menyetujui Request
     */
    public function approve($id)
    {
        $req = ProductRequest::findOrFail($id);
        $product = $req->product;

        // Validasi stok sebelum disetujui
        if ($req->quantity > $product->qty) {
            return back()->with('error', '❌ Stok tidak cukup untuk disetujui.');
        }

        // Kurangi stok produk
        $product->decrement('qty', $req->quantity);

        // Update status request
        $req->update(['status' => 'approved']);

        return back()->with('success', '✅ Request disetujui dan stok berhasil dikurangi.');
    }

    /**
     * ❌ Admin Menolak Request
     */
    public function reject($id)
    {
        $req = ProductRequest::findOrFail($id);

        $req->update(['status' => 'rejected']);

        return back()->with('success', '🚫 Request berhasil ditolak.');
    }
}
