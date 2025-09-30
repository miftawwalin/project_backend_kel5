<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('item_code', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('uom') && $request->uom !== 'all') {
            $query->where('uom', $request->uom);
        }

        if ($request->filled('loc') && $request->loc !== 'all') {
            $query->where('loc', $request->loc);
        }

        if ($request->filled('user') && $request->user !== 'all') {
            $query->where('category', $request->user);
        }

        // ✅ Pagination hanya tampil 10 per halaman
        $products = $query->paginate(10);

        // ✅ Ambil data unik untuk filter
        $uoms = Product::select('uom')->whereNotNull('uom')->distinct()->pluck('uom');
        $locs = Product::select('loc')->whereNotNull('loc')->distinct()->pluck('loc');
        $users = Product::select('category')->whereNotNull('category')->distinct()->pluck('category');

        return view('products.index', compact('products','uoms','locs','users'));
    }

    public function create()
    {
        $categories = Product::select('category')->distinct()->pluck('category');
        $locs = Product::select('loc')->distinct()->pluck('loc');
        $uoms = Product::select('uom')->distinct()->pluck('uom');

        return view('products.create', compact('categories','locs','uoms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_code' => 'required|string|max:100|unique:products,item_code',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'qty' => 'required|integer|min:0',
            'loc' => 'nullable|string|max:100',
            'uom' => 'nullable|string|max:10',
            'min_stock' => 'nullable|integer|min:0',
        ], [
            'item_code.unique' => '⚠️ Kode item sudah dipakai, silakan gunakan kode lain.',
            'item_code.required' => '⚠️ Kode item wajib diisi.',
            'name.required' => '⚠️ Nama produk wajib diisi.',
            'qty.integer' => '⚠️ Qty harus berupa angka.',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        // ✅ Tambahkan pilihan kategori, lokasi, UOM untuk dropdown di edit
        $categories = Product::select('category')->distinct()->pluck('category');
        $locs = Product::select('loc')->distinct()->pluck('loc');
        $uoms = Product::select('uom')->distinct()->pluck('uom');

        return view('products.edit', compact('product','categories','locs','uoms'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'item_code' => 'required|string|max:100|unique:products,item_code,' . $product->id,
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'qty' => 'required|integer|min:0',
            'loc' => 'nullable|string|max:100',
            'uom' => 'nullable|string|max:10',
            'min_stock' => 'nullable|integer|min:0',
        ], [
            'item_code.unique' => '⚠️ Kode item sudah dipakai, silakan gunakan kode lain.',
            'item_code.required' => '⚠️ Kode item wajib diisi.',
            'name.required' => '⚠️ Nama produk wajib diisi.',
            'qty.integer' => '⚠️ Qty harus berupa angka.',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Lewati header (baris pertama)
        foreach ($rows as $index => $row) {
            if ($index == 0) continue;

            if (empty($row[0])) continue;

            Product::updateOrCreate(
                ['item_code' => $row[0]],
                [
                    'name'      => $row[1] ?? '',
                    'category'  => $row[2] ?? '',
                    'loc'       => $row[3] ?? '',
                    'qty'       => (int)($row[4] ?? 0),
                    'uom'       => $row[5] ?? '',
                    'min_stock' => (int)($row[6] ?? 0),
                ]
            );
        }

        return redirect()->route('products.index')->with('success', 'Data produk berhasil diimport.');
    }
}
