<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRequestController extends Controller
{
    /**
     * 🔹 Form Request Barang (User & Admin)
     */
    public function create()
    {
        $products = Product::all();
        $requests = ProductRequest::with(['product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.form-request-user', compact('products', 'requests'));
    }

    /**
     * 🔹 Simpan Permintaan Barang
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string|max:255'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->quantity > $product->qty) {
            return back()->with('error', 'Jumlah permintaan melebihi stok tersedia!');
        }

        ProductRequest::create([
            'user_id' => Auth::id(),
            'department_id' => Auth::user()->department_id ?? null,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'note' => $request->note,
            'status' => 'Pending',
        ]);

        return back()->with('success', 'Permintaan barang berhasil dikirim!');
    }

    /**
     * 🔹 Halaman Admin – Daftar Semua Request
     */
    public function index()
{
    $requests = ProductRequest::with(['user', 'product'])
        ->latest()
        ->get();

    return view('admin.admin-requests', compact('requests'));
}

    /**
     * 🔹 Approve Request
     */
    public function approve($id)
    {
        $req = ProductRequest::findOrFail($id);
        $product = $req->product;

        if ($product->qty < $req->quantity) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $product->qty -= $req->quantity;
        $product->save();

        $req->update([
            'status' => 'Approved',
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Permintaan disetujui dan stok diperbarui.');
    }

    /**
     * 🔹 Reject Request
     */
    public function reject($id)
    {
        ProductRequest::findOrFail($id)->update(['status' => 'Rejected']);
        return back()->with('error', 'Permintaan ditolak.');
    }

    /**
     * 🔹 Dashboard User
     */
    public function userDashboard()
    {
        $user = Auth::user();

        $requests = ProductRequest::where('user_id', $user->id)->get();

        $totalRequests = $requests->count();
        $approvedRequests = $requests->where('status', 'Approved')->count();
        $pendingRequests = $requests->where('status', 'Pending')->count();
        $rejectedRequests = $requests->where('status', 'Rejected')->count();

        $totalProducts = Product::count();
        $lowStock = Product::whereColumn('qty', '<=', 'min_stock')->count();

        return view('user.dashboard', compact(
            'requests',
            'totalRequests',
            'approvedRequests',
            'pendingRequests',
            'rejectedRequests',
            'totalProducts',
            'lowStock'
        ));
    }

    /**
     * 🔹 Dashboard Admin
     */
    public function adminDashboard()
    {
        $requests = ProductRequest::with(['user', 'product', 'department'])->latest()->get();

        $totalRequests = $requests->count();
        $approvedRequests = $requests->where('status', 'Approved')->count();
        $pendingRequests = $requests->where('status', 'Pending')->count();
        $rejectedRequests = $requests->where('status', 'Rejected')->count();

        $totalProducts = Product::count();
        $lowStock = Product::whereColumn('qty', '<=', 'min_stock')->count();

        return view('admin.dashboard', compact(
            'totalRequests',
            'approvedRequests',
            'pendingRequests',
            'rejectedRequests',
            'totalProducts',
            'lowStock'
        ));
    }
}
