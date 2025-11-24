<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductRequestItem;

class ProductRequestController extends Controller
{
    /**
     * FORM REQUEST USER
     */
    public function create()
    {
        $products = Product::all();

        $requests = ProductRequest::with(['items.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.form-request-user', compact('products', 'requests'));
    }


    /**
     * FORM REQUEST ADMIN
     */
    public function adminForm()
    {
        $products = Product::all();

        $requests = ProductRequest::with(['items.product', 'user'])
            ->latest()
            ->get();

        return view('pages.form-request-admin', compact('products', 'requests'));
    }


    /**
     * SIMPAN REQUEST (MULTI ITEM)
     */
    public function store(Request $request)
    {
        $request->validate([
            'npk' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'items' => 'required',
        ]);

        $items = json_decode($request->items, true);

        if (!$items || count($items) == 0) {
            return back()->with('error', 'Item belum ditambahkan');
        }

        // Simpan header
        $header = ProductRequest::create([
            'user_id' => Auth::id(),
            'department_id' => Auth::user()->department_id,
            'status' => 'pending',
            'note' => 'Request oleh ' . $request->nama,
        ]);

        // Simpan semua item
        foreach ($items as $i) {

            $product = Product::where('item_code', $i['code'])->first();

            ProductRequestItem::create([
                'product_request_id' => $header->id,
                'product_id' => $product?->id,
                'qty' => $i['qty'],
                'validated' => false
            ]);
        }

        return redirect()->back()->with('success', 'Request berhasil dikirim');
    }


    /**
     * LIST REQUEST ADMIN
     */
    public function index()
    {
        $requests = ProductRequest::with(['items.product', 'user'])
            ->latest()
            ->get();

        return view('admin.admin-requests', compact('requests'));
    }


    /**
     * APPROVE REQUEST MULTI ITEM
     */
    public function approve($id)
    {
        $req = ProductRequest::with('items.product')->findOrFail($id);

        // Cek semua item apakah stok cukup
        foreach ($req->items as $item) {
            if ($item->product->ending_balance_september < $item->qty) {
                return back()->with('error', 'Stok barang ' . $item->product->name . ' tidak cukup!');
            }
        }

        // Kurangi stok
        foreach ($req->items as $item) {
            $p = $item->product;
            $p->ending_balance_september -= $item->qty;
            $p->save();
        }

        // Update status request
        $req->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Permintaan disetujui dan stok diperbarui.');
    }


    /**
     * REJECT REQUEST
     */
    public function reject($id)
    {
        ProductRequest::findOrFail($id)->update([
            'status' => 'rejected'
        ]);

        return back()->with('error', 'Permintaan ditolak.');
    }


    /**
     * DASHBOARD USER
     */
    public function userDashboard()
    {
        $userId = Auth::id();

        $totalRequests = ProductRequest::where('user_id', $userId)->count();
        $pendingRequests = ProductRequest::where('user_id', $userId)->where('status', 'pending')->count();
        $approvedRequests = ProductRequest::where('user_id', $userId)->where('status', 'approved')->count();

        $requests = ProductRequest::where('user_id', $userId)
            ->with('items.product')
            ->latest()
            ->take(10)
            ->get();

        return view('user.dashboard', compact(
            'totalRequests',
            'pendingRequests',
            'approvedRequests',
            'requests'
        ));
    }


    /**
     * DASHBOARD ADMIN
     */
    public function adminDashboard()
    {
        $requests = ProductRequest::with(['user','items.product'])->latest()->get();


        $totalRequests    = $requests->count();
        $pendingRequests  = $requests->where('status', 'pending')->count();
        $approvedRequests = $requests->where('status', 'approved')->count();
        $rejectedRequests = $requests->where('status', 'rejected')->count();

        $latestRequests = ProductRequest::with(['user', 'items.product'])
            ->latest()
            ->take(10)
            ->get();

        // Grafik status
        $chartStatus = [
            'pending'  => $pendingRequests,
            'approved' => $approvedRequests,
            'rejected' => $rejectedRequests,
        ];

        // Grafik bulanan
        $monthly = ProductRequest::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalRequests',
            'pendingRequests',
            'approvedRequests',
            'rejectedRequests',
            'requests',
            'latestRequests',
            'chartStatus',
            'monthly'
        ));
    }
}
