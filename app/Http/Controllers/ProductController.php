<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Product;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    // ✅ Halaman informasi stok (bisa diakses user)
public function stockInfo(Request $request)
{
    // Query produk + relasi departemen - ambil semua data tanpa pagination
    $query = Product::with('department');

    // Filter pencarian hanya berdasarkan name (opsional, karena filter client-side)
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Ambil semua data produk tanpa pagination
    $products = $query->orderBy('item_code')->get();

    // Statistik ringkas
    $totalItems = Product::count();
    $lowStock = Product::whereColumn('qty', '<', 'min_stock')->count();
    $outStock = Product::where('qty', '<=', 0)->count();

    // Kirim ke view
    return view('pages.stock-information', compact(
        'products',
        'totalItems', 'lowStock', 'outStock'
    ));
}




    // ➕ Halaman tambah produk
    public function create(Request $request)
    {
        // Fetch products for the list table, similar to index
        $query = Product::with('department');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('item_code', 'like', '%' . $request->search . '%')
                    ->orWhere('name', 'like', '%' . $request->search . '%');
            });
        }
        
        $products = $query->orderBy('item_code')->paginate(10);

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

        return view('pages.add-product', compact('departments', 'categories', 'locs', 'uoms', 'products'));
    }

    // 🧨 Hapus SEMUA produk (Clear Table)
    public function destroyAll()
    {
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();
        
        return redirect()->back()->with('success', 'Semua data produk berhasil dihapus (Truncate).');
    }


    // 💾 Simpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_code' => 'required|string|max:100|unique:products,item_code',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'qty' => 'required|integer|min:0',
            'stock_max' => 'nullable|integer|min:0',
            'titik_order' => 'nullable|integer|min:0',
            'loc' => 'nullable|string|max:100',
            'uom' => 'nullable|string|max:10',
            'min_stock' => 'nullable|integer|min:0',
            'department_name' => 'nullable|string|max:100', // Validate manual input
        ]);

        // Resolve Department ID from Name
        if (!empty($validated['department_name'])) {
            $dept = Department::where('name', $validated['department_name'])->first();
            $validated['department_id'] = $dept ? $dept->id : null;
            unset($validated['department_name']); // Remove non-column field
        } else {
            $validated['department_id'] = null;
        }

        Product::create($validated);
        return redirect()->route('inventory-dashboard')->with('success', 'Produk berhasil ditambahkan.');
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
            'stock_max' => 'nullable|integer|min:0',
            'titik_order' => 'nullable|integer|min:0',
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

    // 🗑️ Bulk Delete
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:products,id',
        ]);

        Product::whereIn('id', $request->ids)->delete();

        return redirect()->back()->with('success', count($request->ids) . ' produk berhasil dihapus.');
    }

    // 📤 Import Excel
    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls,csv']);
        $file = $request->file('file');
        
        try {
            $spreadsheet = IOFactory::load($file->getRealPath());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['file' => 'Error loading file: ' . $e->getMessage()]);
        }

        $rows = $spreadsheet->getActiveSheet()->toArray();

        // 1. Identifikasi Header
        $headerRow = $rows[0] ?? [];
        $columnMap = [];

        // Normalisasi header agar case-insensitive
        foreach ($headerRow as $index => $colName) {
            if (!$colName) continue;
            $cleanName = strtoupper(trim(preg_replace('/\s+/', ' ', $colName)));
            $columnMap[$cleanName] = $index;
        }

        // Definisi kolom wajib & opsional
        // Map Key (Upper) => DB Variable
        $mapConfig = [
            'ITEM CODE'   => 'itemCode',
            'NAME'        => 'name',
            'UOM'         => 'uom',
            'LOC'         => 'loc',
            'QTY'         => 'qty',
            'STOCK MAX'   => 'stockMax',
            'TITIK ORDER' => 'titikOrder',
            'MIN STOCK'   => 'minStock',
            'USER'        => 'user',
            'CATEGORY'    => 'category',
        ];

        // Validasi apakah kolom ITEM CODE dan NAME ada
        if (!isset($columnMap['ITEM CODE']) || !isset($columnMap['NAME'])) {
            return redirect()->back()->withErrors(['file' => 'Format Excel salah. Kolom ITEM CODE dan NAME wajib ada.']);
        }

        $imported = 0;
        $updated = 0;

        foreach ($rows as $index => $row) {
            if ($index == 0) continue; // Skip header

            // Helper untuk ambil data berdasarkan nama kolom
            $getValue = function($key, $default = '') use ($columnMap, $row) {
                $idx = $columnMap[$key] ?? null;
                return $idx !== null ? trim($row[$idx] ?? '') : $default;
            };

            $itemCode = $getValue('ITEM CODE');
            $name     = $getValue('NAME');

            if (empty($itemCode) || empty($name)) continue;

            // Ambil data lain
            $uom      = $getValue('UOM');
            $loc      = $getValue('LOC');
            $category = $getValue('CATEGORY');
            $user     = $getValue('USER'); // Department

            // Numeric Cleaning
            $qty        = intval(preg_replace('/[^0-9]/', '', $getValue('QTY', '0')));
            $stockMax   = intval(preg_replace('/[^0-9]/', '', $getValue('STOCK MAX', '0')));
            $titikOrder = intval(preg_replace('/[^0-9]/', '', $getValue('TITIK ORDER', '0')));
            $minStock   = intval(preg_replace('/[^0-9]/', '', $getValue('MIN STOCK', '0')));
            
            // Handle Department
            $departmentId = null;
            if (!empty($user)) {
                $department = Department::firstOrCreate(['name' => $user]);
                $departmentId = $department->id;
            }

            $product = Product::updateOrCreate(
                ['item_code' => $itemCode],
                [
                    'name'          => $name,
                    'category'      => $category,
                    'qty'           => $qty,
                    'stock_max'     => $stockMax,
                    'titik_order'   => $titikOrder,
                    'min_stock'     => $minStock,
                    'loc'           => $loc,
                    'uom'           => $uom,
                    'department_id' => $departmentId,
                ]
            );

            if ($product->wasRecentlyCreated) {
                $imported++;
            } else {
                $updated++;
            }
        }

        $message = "Import berhasil! {$imported} item baru ditambahkan, {$updated} item diperbarui.";

        // Redirect logic - selalu redirect ke inventory-dashboard
        return redirect()->route('inventory-dashboard')->with('success', $message);
    }

    // 📊 Inventory Dashboard - Menggunakan database products yang sama dengan /products
    public function inventoryDashboard(Request $request)
    {
        $query = Product::with('department');

        // Filter pencarian (sama seperti index)
        // Filter pencarian (fokus mencari name saja)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category') && $request->category !== '' && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filter UOM
        if ($request->filled('uom') && $request->uom !== '' && $request->uom !== 'all') {
            $query->where('uom', $request->uom);
        }

        // Filter Location
        if ($request->filled('loc') && $request->loc !== '' && $request->loc !== 'all') {
            $query->where('loc', $request->loc);
        }

        // Filter User/Department (sama seperti index)
        if ($request->filled('user') && $request->user !== '' && $request->user !== 'all') {
            $query->whereHas('department', function ($q) use ($request) {
                $q->where('name', $request->user);
            });
        } elseif ($request->filled('department') && $request->department !== '' && $request->department !== 'all') {
            $query->where('department_id', $request->department);
        }

        // Ambil semua data tanpa pagination (sama seperti informasi-stock)
        $products = $query->orderBy('item_code')->get();

        // Data untuk filter dropdown (sama seperti index)
        $uoms = Product::select('uom')->whereNotNull('uom')->distinct()->pluck('uom');
        $locs = Product::select('loc')->whereNotNull('loc')->distinct()->pluck('loc');
        $departments = Department::orderBy('name')->get();
        $categories = Product::select('category')->whereNotNull('category')->distinct()->pluck('category');

        // Statistik dari database products
        $totalItems = Product::count();
        $lowStock = Product::whereColumn('qty', '<', 'min_stock')->count();
        $outStock = Product::where('qty', '<=', 0)->count();
        $totalGR = Product::sum('total_gr_september') ?? 0;
        $totalGI = Product::sum('gi_september') ?? 0;
        $totalBalance = Product::sum('ending_balance_september') ?? 0;

        return view('pages.inventory-dashboard', compact(
            'products',
            'uoms',
            'locs',
            'departments',
            'categories',
            'totalItems',
            'lowStock',
            'outStock',
            'totalGR',
            'totalGI',
            'totalBalance'
        ));
    }

    /**
     * Stock Minim - Item yang mencapai titik order
     */
    public function stockMinim(Request $request)
    {
        $query = Product::with('department')
            ->whereColumn('qty', '<=', 'titik_order')
            ->whereNotNull('titik_order')
            ->where('titik_order', '>', 0);

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter Category
        if ($request->filled('category') && $request->category !== '' && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filter Department
        if ($request->filled('department') && $request->department !== '' && $request->department !== 'all') {
            $query->where('department_id', $request->department);
        }

        // Ambil semua data tanpa pagination, urutkan berdasarkan prioritas (qty paling rendah dulu)
        $products = $query->orderByRaw('(qty / NULLIF(titik_order, 0)) ASC')
            ->orderBy('name')
            ->get();

        // Statistik
        $totalKritikal = Product::whereColumn('qty', '<=', 'titik_order')
            ->whereNotNull('titik_order')
            ->where('titik_order', '>', 0)
            ->count();
        
        $totalPeringatan = Product::whereColumn('qty', '>', 'titik_order')
            ->whereColumn('qty', '<=', 'min_stock')
            ->whereNotNull('min_stock')
            ->where('min_stock', '>', 0)
            ->count();

        $outOfStock = Product::where('qty', '<=', 0)
            ->whereNotNull('titik_order')
            ->where('titik_order', '>', 0)
            ->count();

        // Data untuk filter
        $categories = Product::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');
        
        $departments = Department::orderBy('name')->get();

        return view('pages.stock-minim', compact(
            'products', 'categories', 'departments',
            'totalKritikal', 'totalPeringatan', 'outOfStock'
        ));
    }
}
