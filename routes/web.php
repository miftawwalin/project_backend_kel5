<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRequestController;
use App\Http\Controllers\ExportController;

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Stok Info (Admin & User)
|--------------------------------------------------------------------------
*/
Route::get('/products/informasi-stock', [ProductController::class, 'stockInfo'])
    ->middleware(['auth'])
    ->name('informasi-stock');

/*
|--------------------------------------------------------------------------
| Request By User (ADMIN & USER)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/form-request-user', [ProductRequestController::class, 'create'])
        ->name('form-request-user');

    Route::post('/requests', [ProductRequestController::class, 'store'])
    ->name('requests.store');

});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
    Route::middleware(['auth', 'role:admin', 'prevent-back-history'])->group(function () {

    Route::get('/add-product', fn() => view('pages.add-product'))
        ->name('add-product');

    // Dashboard Admin
    Route::get('/admin/dashboard', [ProductRequestController::class, 'adminDashboard'])
        ->name('admin.dashboard');

    // Form request admin
    Route::get('/admin/form-request', [ProductRequestController::class, 'adminForm'])
        ->name('admin.form-request');

    // Scan product (AJAX)
    Route::get('/admin/get-product/{code}', [ProductRequestController::class, 'getProduct'])
        ->name('admin.get-product');

    // Simpan request admin
    Route::post('/admin/store-request', [ProductRequestController::class, 'storeByAdmin'])
        ->name('admin.store-request');

    // List request pending/approved/rejected
    Route::get('/requests/admin', [ProductRequestController::class, 'index'])
        ->name('requests.index');

    Route::post('/requests/{id}/approve', [ProductRequestController::class, 'approve'])
        ->name('requests.approve');

    Route::post('/requests/{id}/reject', [ProductRequestController::class, 'reject'])
        ->name('requests.reject');

    // Export
    Route::get('/export/request', [ExportController::class, 'exportRequest'])
        ->name('export.request');

    Route::get('/export/product', [ExportController::class, 'exportProduct'])
        ->name('export.product');

    // CRUD Product
    Route::resource('products', ProductController::class);
    Route::post('/products/import', [ProductController::class, 'import'])
        ->name('products.import');
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [ProductRequestController::class, 'userDashboard'])
        ->name('user.dashboard');
});

/*
|--------------------------------------------------------------------------
| Static Pages
|--------------------------------------------------------------------------
*/
Route::get('/user-informasi', fn() => view('pages.user-informasi'))->name('user-informasi');
Route::get('/inventory-dashboard', fn() => view('pages.inventory-dashboard'))->name('inventory-dashboard');
Route::get('/inventory-items', fn() => view('pages.inventory-items'))->name('inventory-items');
Route::get('/inventory-movements', fn() => view('pages.inventory-movements'))->name('inventory-movements');
Route::get('/inventory-reports', fn() => view('pages.inventory-reports'))->name('inventory-reports');
Route::get('/about', fn() => view('pages.about'))->name('about');
Route::get('/contact', fn() => view('pages.contact'))->name('contact');

/*
|--------------------------------------------------------------------------
| Dashboard redirect
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
