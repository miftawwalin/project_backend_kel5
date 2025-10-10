<?php

namespace App\Http\Controllers;

use App\Models\RequestProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    // 📌 User liht form request
    public function create()
    {
        $products = Product::all();
        return view('requests.create', compact('products'));
    }

    // 📌 User submit request
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        RequestProduct::create([
            'user_id'   => Auth::id(),
            'product_id'=> $request->product_id,
            'quantity'  => $request->quantity,
            'status'    => 'pending'
        ]);

        return redirect()->route('requests.user')->with('success','Request berhasil diajukan');
    }

    // 📌 User lihat request miliknya
    public function userIndex()
    {
        $requests = RequestProduct::where('user_id', Auth::id())->with('product')->get();
        return view('requests.user_index', compact('requests'));
    }

    // 📌 Admin lihat semua request
    public function index()
    {
        $requests = RequestProduct::with('user','product')->get();
        return view('requests.index', compact('requests'));
    }

    // 📌 Admin approve
    public function approve($id)
    {
        $req = RequestProduct::findOrFail($id);
        $product = $req->product;

        if ($product->qty < $req->quantity) {
            return back()->withErrors('Stok tidak cukup!');
        }

        $req->status = 'approved';
        $req->save();

        // stok berkurang
        $product->qty -= $req->quantity;
        $product->save();

        return back()->with('success','Request disetujui dan stok berkurang');
    }

    // 📌 Admin reject
    public function reject($id)
    {
        $req = RequestProduct::findOrFail($id);
        $req->status = 'rejected';
        $req->save();

        return back()->with('success','Request ditolak');
    }
}
