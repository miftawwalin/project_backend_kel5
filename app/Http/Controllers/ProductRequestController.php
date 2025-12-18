<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductRequestItem;

class ProductRequestController extends Controller
{
    /**
     * FORM REQUEST USER
     */
    public function create()
    {
        $products = Product::with('department')->get();

        $requests = ProductRequest::with(['items.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.form-request-user', compact('products', 'requests'));
    }


    /**
     * FORM REQUEST ADMIN (Bisa diakses Admin & User)
     */
    public function adminForm()
    {
        $products = Product::all();

        // Jika admin, tampilkan semua request. Jika user, hanya request miliknya
        if (Auth::user()->role === 'admin') {
            $requests = ProductRequest::with(['items.product', 'user'])
                ->latest()
                ->get();
        } else {
            $requests = ProductRequest::with(['items.product', 'user'])
                ->where('user_id', Auth::id())
                ->latest()
                ->get();
        }

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

        try {
            // Simpan header
            $header = ProductRequest::create([
                'user_id' => Auth::id(),
                'department_id' => Auth::user()->department_id,
                'status' => 'pending',
                'note' => 'Request oleh ' . $request->nama . ' (NPK: ' . $request->npk . ')',
                'request_date' => $request->tanggal,
                'npk_nama' => $request->npk . ' - ' . $request->nama
            ]);

            // Simpan semua item
            foreach ($items as $i) {
                $product = Product::where('item_code', $i['code'])->first();
                
                // Skip if product not found, or handle error
                if (!$product) continue;

                ProductRequestItem::create([
                    'product_request_id' => $header->id,
                    'product_id' => $product->id,
                    'qty' => $i['qty'],
                    'validated' => false,
                    'note' => $i['note'] ?? null
                ]);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan request: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Request berhasil dikirim');
    }

    /**
     * QUICK STORE REQUEST - Untuk request langsung dari stock minim
     */
    public function quickStore(Request $request)
    {
        $request->validate([
            'item_code' => 'required|string',
            'qty' => 'required|integer|min:1',
        ]);

        try {
            $product = Product::where('item_code', $request->item_code)->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item tidak ditemukan'
                ], 404);
            }

            // Validasi qty tidak melebihi stock
            if ($request->qty > $product->qty) {
                return response()->json([
                    'success' => false,
                    'message' => 'Qty tidak boleh melebihi stock yang tersedia! Stock tersedia: ' . $product->qty
                ], 400);
            }

            // Buat header request
            $header = ProductRequest::create([
                'user_id' => Auth::id(),
                'department_id' => Auth::user()->department_id,
                'status' => 'pending',
                'note' => 'Quick request dari Stock Minim',
                'request_date' => now(),
                'npk_nama' => Auth::user()->name . ' (NPK: ' . (Auth::user()->npk ?? '-') . ')'
            ]);

            // Simpan item
            ProductRequestItem::create([
                'product_request_id' => $header->id,
                'product_id' => $product->id,
                'qty' => $request->qty,
                'validated' => false,
                'note' => $request->note ?? null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Request berhasil dikirim',
                'data' => [
                    'request_id' => $header->id,
                    'qty' => $request->qty
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan request: ' . $e->getMessage()
            ], 500);
        }
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
            if ($item->product->qty < $item->qty) {
                return back()->with('error', 'Stok barang ' . $item->product->name . ' tidak cukup!');
            }
        }

        // Kurangi stok
        foreach ($req->items as $item) {
            $p = $item->product;
            $p->qty -= $item->qty;
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

    /**
     * GET PRODUCT berdasarkan ITEM CODE (SCAN)
     */
    public function getProduct($code)
    {
        $product = Product::with('department')->where('item_code', $code)->first();

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Item tidak ditemukan'
            ]);
        }

        // Tambahkan department_name ke response
        $productData = $product->toArray();
        $productData['department_name'] = $product->department ? $product->department->name : '-';

        return response()->json([
            'status' => true,
            'data' => $productData
        ]);
    }


    // SIMPAN REQUEST ADMIN via SCAN
    public function storeByAdmin(Request $request)
    {
        // Validasi
        $request->validate([
            'tanggal' => 'required|date',
            'npk_nama' => 'required',
            'items' => 'required'
        ]);

        // Ubah JSON string → array
        $items = json_decode($request->items, true);

        if (!$items || count($items) < 1) {
            return back()->with('error', 'Item request tidak boleh kosong!');
        }

        try {
            // Buat header request
            $header = ProductRequest::create([
                'user_id' => Auth::id(),
                'department_id' => Auth::user()->department_id,
                'status' => 'pending', 
                'note' => 'Request Input By Admin',
                'request_date' => $request->tanggal,
                'npk_nama' => $request->npk_nama
            ]);

            // Simpan item-detail
            foreach ($items as $i) {
                $product = Product::where('item_code', $i['itemCode'])->first();

                ProductRequestItem::create([
                    'product_request_id' => $header->id,
                    'product_id' => $product?->id,
                    'qty' => $i['qty'],
                    'validated' => false,
                    'note' => $i['note'] ?? null
                ]);
            }

            return redirect()
                ->route('requests.index')
                ->with('success', 'Request berhasil dibuat dan menunggu approval!');
        
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * EDIT REQUEST
     */
    public function edit($id)
    {
        $request = ProductRequest::with(['items.product', 'user', 'department'])->findOrFail($id);
        $products = Product::with('department')->get();
        return view('pages.edit-request', compact('request', 'products'));
    }

    /**
     * UPDATE REQUEST
     */
    public function update(Request $request, $id)
    {
        $productRequest = ProductRequest::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'note' => 'nullable|string|max:255',
        ]);

        // Jika status berubah dari approved ke rejected atau sebaliknya, update stock
        if ($productRequest->status === 'approved' && $request->status !== 'approved') {
            // Kembalikan stock
            foreach ($productRequest->items as $item) {
                $product = $item->product;
                if ($product) {
                    $product->qty += $item->qty;
                    $product->save();
                }
            }
        } elseif ($productRequest->status !== 'approved' && $request->status === 'approved') {
            // Kurangi stock
            foreach ($productRequest->items as $item) {
                $product = $item->product;
                if ($product && $product->qty >= $item->qty) {
                    $product->qty -= $item->qty;
                    $product->save();
                } else {
                    return back()->with('error', 'Stock tidak cukup untuk item ' . ($product->name ?? 'Unknown'));
                }
            }
        }

        $productRequest->update([
            'status' => $request->status,
            'note' => $request->note ?? $productRequest->note,
            'approved_at' => $request->status === 'approved' ? now() : null,
        ]);

        return redirect()->route('requests.index')->with('success', 'Request berhasil diupdate');
    }

    /**
     * DELETE REQUEST
     */
    public function destroy($id)
    {
        $productRequest = ProductRequest::findOrFail($id);
        
        DB::transaction(function () use ($productRequest) {
            // Kembalikan stock jika approved
            if ($productRequest->status === 'approved') {
                foreach ($productRequest->items as $item) {
                    $product = $item->product;
                    if ($product) {
                        $product->qty += $item->qty;
                        $product->save();
                    }
                }
            }
            
            // Hapus items terlebih dahulu
            $productRequest->items()->delete();
            // Hapus request
            $productRequest->delete();
        });

        return redirect()->route('requests.index')->with('success', 'Request berhasil dihapus');
    }

    /**
     * BULK DELETE REQUESTS
     */
    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return back()->with('error', 'Tidak ada item yang dipilih');
        }

        $productRequests = ProductRequest::with('items.product')->whereIn('id', $ids)->get();
        
        DB::transaction(function () use ($productRequests) {
            foreach ($productRequests as $productRequest) {
                // Kembalikan stock jika approved
                if ($productRequest->status === 'approved') {
                    foreach ($productRequest->items as $item) {
                        $product = $item->product;
                        if ($product) {
                            $product->qty += $item->qty;
                            $product->save();
                        }
                    }
                }
                
                // Hapus items
                $productRequest->items()->delete();
                // Hapus request
                $productRequest->delete();
            }
        });

        return back()->with('success', count($ids) . ' request(s) berhasil dihapus');
    }

    /**
     * DELETE ALL REQUESTS
     */
    public function destroyAll(Request $request)
    {
        $productRequests = ProductRequest::all();
        $count = $productRequests->count();

        DB::transaction(function () use ($productRequests) {
            foreach ($productRequests as $productRequest) {
                // Kembalikan stock jika approved
                if ($productRequest->status === 'approved') {
                    foreach ($productRequest->items as $item) {
                        $product = $item->product;
                        if ($product) {
                            $product->qty += $item->qty;
                            $product->save();
                        }
                    }
                }
                
                // Hapus items
                $productRequest->items()->delete();
                // Hapus request
                $productRequest->delete();
            }
        });

        return back()->with('success', $count . ' request(s) berhasil dihapus');
    }
}
