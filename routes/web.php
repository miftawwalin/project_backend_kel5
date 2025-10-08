<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductRequestController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Product Management (Admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');
    Route::get('/add-product', fn() => view('pages.add-product'))->name('add-product');
});

/*
|--------------------------------------------------------------------------
| Request Barang (User & Admin)
|--------------------------------------------------------------------------
*/

// === USER ===
Route::middleware(['auth', 'role:user'])->group(function () {
    // form request barang
    Route::get('/requests/create', [ProductRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [ProductRequestController::class, 'store'])->name('requests.store');

    // daftar request milik user
    Route::get('/requests/user', [ProductRequestController::class, 'userIndex'])->name('requests.user');

    // dashboard user
    Route::get('/user/dashboard', fn() => view('user.dashboard'))->name('user.dashboard');
});

// === ADMIN ===
Route::middleware(['auth', 'role:admin'])->group(function () {
    // halaman admin melihat semua request
    Route::get('/requests/admin', [ProductRequestController::class, 'index'])->name('requests.index');

    // approve / reject request
    Route::post('/requests/{id}/approve', [ProductRequestController::class, 'approve'])->name('requests.approve');
    Route::post('/requests/{id}/reject', [ProductRequestController::class, 'reject'])->name('requests.reject');

    // dashboard admin
    Route::get('/admin/dashboard', fn() => view('admin.dashboard_admin'))->name('admin.dashboard');
});

/*
|--------------------------------------------------------------------------
| General Pages
|--------------------------------------------------------------------------
*/

Route::get('/informasi-stock', fn() => view('pages.informasi-stock'))->name('informasi-stock');
Route::get('/user-informasi', fn() => view('pages.user-informasi'))->name('user-informasi');
Route::get('/inventory-dashboard', fn() => view('pages.inventory-dashboard'))->name('inventory-dashboard');
Route::get('/inventory-items', fn() => view('pages.inventory-items'))->name('inventory-items');
Route::get('/inventory-movements', fn() => view('pages.inventory-movements'))->name('inventory-movements');
Route::get('/inventory-reports', fn() => view('pages.inventory-reports'))->name('inventory-reports');
Route::get('/about', fn() => view('pages.about'))->name('about');
Route::get('/contact', fn() => view('pages.contact'))->name('contact');
