<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRequestController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| INFORMASI STOK (ADMIN & USER)
|--------------------------------------------------------------------------
*/
Route::get('/products/informasi-stock', [ProductController::class, 'stockInfo'])
    ->middleware(['auth', 'prevent-back-history'])
    ->name('informasi-stock');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin', 'prevent-back-history'])->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', fn() => view('admin.dashboard_admin'))->name('admin.dashboard');

    // CRUD Produk
    Route::resource('products', ProductController::class);
    Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');
    Route::get('/add-product', fn() => view('pages.add-product'))->name('add-product');

    // Manage Requests
    Route::get('/requests/admin', [ProductRequestController::class, 'index'])->name('requests.index');
    Route::post('/requests/{id}/approve', [ProductRequestController::class, 'approve'])->name('requests.approve');
    Route::post('/requests/{id}/reject', [ProductRequestController::class, 'reject'])->name('requests.reject');

    // 🔹 Tambahkan agar ADMIN juga bisa membuka form request user
    Route::get('/form-request-user', [ProductRequestController::class, 'create'])->name('form-request-user');
    Route::post('/requests', [ProductRequestController::class, 'store'])->name('requests.store');
});

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user', 'prevent-back-history'])->group(function () {

    // Dashboard User
    Route::get('/user/dashboard', [ProductRequestController::class, 'userDashboard'])->name('user.dashboard');

    // Request Barang (Form dan List)
    Route::get('/requests/create', [ProductRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [ProductRequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/user', [ProductRequestController::class, 'userIndex'])->name('requests.user');

    // Form Request User
    Route::get('/form-request-user', [ProductRequestController::class, 'create'])->name('form-request-user');
});

/*
|--------------------------------------------------------------------------
| GENERAL PAGES
|--------------------------------------------------------------------------
*/
Route::get('/user-informasi', fn() => view('pages.user-informasi'))->name('user-informasi');
Route::get('/inventory-dashboard', fn() => view('pages.inventory-dashboard'))->name('inventory-dashboard');
Route::get('/inventory-items', fn() => view('pages.inventory-items'))->name('inventory-items');
Route::get('/inventory-movements', fn() => view('pages.inventory-movements'))->name('inventory-movements');
Route::get('/inventory-reports', fn() => view('pages.inventory-reports'))->name('inventory-reports');
Route::get('/about', fn() => view('pages.about'))->name('about');
Route::get('/contact', fn() => view('pages.contact'))->name('contact');
Route::get('/form-request-admin', fn() => view('pages.form-request-admin'))->name('form-request-admin');

/*
|--------------------------------------------------------------------------
| UNIVERSAL DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
})->name('dashboard');
