<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Product;
use App\Models\Department;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 🧭 Halaman utama stok (informasi & CRUD untuk admin)
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
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

        if ($request->filled('department') && $request->department !== 'all') {
            $query->where('department_id', $request->department);
        }

        $products = $query->paginate(10);
        $uoms = Product::select('uom')->distinct()->pluck('uom');
        $locs = Product::select('loc')->distinct()->pluck('loc');
        $departments = Department::orderBy('name')->get();
        $categories = Product::select('category')->distinct()->pluck('category');

        $totalItems = Product::count();
        $lowStock = Product::whereColumn('qty', '<', 'min_stock')->count();
        $outStock = Product::where('qty', '<=', 0)->count();

        return view('products.index', compact(
            'products', 'uoms', 'locs', 'departments', 'categories',
            'totalItems', 'lowStock', 'outStock'
        ));
    }

    // ✅ Halaman informasi stok (bisa diakses user)
public function stockInfo(Request $request)
{
    $today = now()->toDateString();

    // Query produk + relasi departemen
    $query = Product::with('department');

    // Filter pencarian
    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('item_code', 'like', '%' . $request->keyword . '%')
              ->orWhere('name', 'like', '%' . $request->keyword . '%');
        });
    }

    if ($request->filled('uom') && $request->uom !== 'all') {
        $query->where('uom', $request->uom);
    }

    if ($request->filled('loc') && $request->loc !== 'all') {
        $query->where('loc', $request->loc);
    }

    if ($request->filled('department') && $request->department !== 'all') {
        $query->where('department_id', $request->department);
    }

    // Ambil data produk
    $products = $query->orderBy('item_code')->paginate(10);

    // Filter dropdown
    $uoms = Product::select('uom')->whereNotNull('uom')->distinct()->pluck('uom');
    $locs = Product::select('loc')->whereNotNull('loc')->distinct()->pluck('loc');
    $departments = Department::orderBy('name')->get();

    // Statistik ringkas
    $totalItems = Product::count();
    $lowStock = Product::whereColumn('qty', '<', 'min_stock')->count();
    $outStock = Product::where('qty', '<=', 0)->count();

    // === Perhitungan GR / GI harian (tanpa kolom 'type') ===
    // Untuk sementara GR dan GI sama-sama dihitung dari request yang disetujui hari ini
    $totalGR = \App\Models\ProductRequest::where('status', 'Approved')
        ->whereDate('created_at', $today)
        ->sum('quantity');

    $totalGI = \App\Models\ProductRequest::where('status', 'Approved')
        ->whereDate('created_at', $today)
        ->sum('quantity');

    $totalEnding = Product::sum('qty');

    // Kirim ke view
    return view('pages.stock-information', compact(
        'products', 'uoms', 'locs', 'departments',
        'totalItems', 'lowStock', 'outStock',
        'totalGR', 'totalGI', 'totalEnding'
    ));
}




    // ➕ Halaman tambah produk
    public function create()
{
    // Jika database belum lengkap, isi manual seperti di filter
    $departments = collect([
        (object)['id' => 1, 'name' => 'PPIC'],
        (object)['id' => 2, 'name' => 'QC'],
        (object)['id' => 3, 'name' => 'DIES SHOP'],
        (object)['id' => 4, 'name' => 'PRODUCTION'],
        (object)['id' => 5, 'name' => 'QA'],
        (object)['id' => 6, 'name' => 'Maintenance'],
    ]);

    $categories = collect(['Sparepart', 'Elektrikal', 'Material', 'Consumable']);

    $locs = collect([
        'D-5-1(A.1)', 'OIL AREA', 'D-1-4 (E.2)', 'E-2-4 (C.1)',
    ]);

    $uoms = collect([
        'Pcs', 'Ltr', 'CAN', 'DRUM', 'GALON', 'Pail', 'BTL',
    ]);

    return view('products.create', compact('departments', 'categories', 'locs', 'uoms'));
}


    // 💾 Simpan produk baru
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
            'department_id' => 'nullable|exists:departments,id',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // ✏️ Edit produk
    public function edit(Product $product)
    {
        $departments = Department::orderBy('name')->get();
        $categories = Product::select('category')->distinct()->pluck('category');
        $locs = Product::select('loc')->distinct()->pluck('loc');
        $uoms = Product::select('uom')->distinct()->pluck('uom');

        return view('products.edit', compact('product', 'departments', 'categories', 'locs', 'uoms'));
    }

    // 🔄 Update produk
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
            'department_id' => 'nullable|exists:departments,id',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // 🗑️ Hapus produk
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    // 📤 Import Excel
    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls,csv']);
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $rows = $spreadsheet->getActiveSheet()->toArray();

        foreach ($rows as $index => $row) {
            if ($index == 0) continue;
            if (empty($row[0])) continue;

            Product::updateOrCreate(
                ['item_code' => $row[0]],
                [
                    'name' => $row[1] ?? '',
                    'category' => $row[2] ?? '',
                    'loc' => $row[3] ?? '',
                    'qty' => (int)($row[4] ?? 0),
                    'uom' => $row[5] ?? '',
                    'min_stock' => (int)($row[6] ?? 0),
                ]
            );
        }

        return redirect()->route('products.index')->with('success', 'Data produk berhasil diimport.');
    }
}
