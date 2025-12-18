<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRequestController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\InventoryMovementController;
use App\Http\Controllers\UserController;

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

    Route::post('/requests/quick', [ProductRequestController::class, 'quickStore'])
        ->name('requests.quick-store');

});

/*
|--------------------------------------------------------------------------
| Scan Barcode (Admin & User)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Form request dengan scan barcode (bisa diakses admin dan user)
    Route::get('/admin/form-request', [ProductRequestController::class, 'adminForm'])
        ->name('admin.form-request');

    // Scan product (AJAX)
    Route::get('/admin/get-product/{code}', [ProductRequestController::class, 'getProduct'])
        ->name('admin.get-product');

    // Simpan request
    Route::post('/admin/store-request', [ProductRequestController::class, 'storeByAdmin'])
        ->name('admin.store-request');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
    Route::middleware(['auth', 'role:admin', 'prevent-back-history'])->group(function () {

    Route::get('/add-product', [ProductController::class, 'create'])
        ->name('add-product');

    // Dashboard Admin
    Route::get('/admin/dashboard', [ProductRequestController::class, 'adminDashboard'])
        ->name('admin.dashboard');

    // List request pending/approved/rejected
    Route::get('/requests/admin', [ProductRequestController::class, 'index'])
        ->name('requests.index');

    Route::post('/requests/{id}/approve', [ProductRequestController::class, 'approve'])
        ->name('requests.approve');

    Route::post('/requests/{id}/reject', [ProductRequestController::class, 'reject'])
        ->name('requests.reject');

    // Bulk Delete & Delete All (must be before routes with {id} parameter)
    Route::delete('/requests/bulk-delete', [ProductRequestController::class, 'bulkDestroy'])
        ->name('requests.bulkDestroy');
    
    Route::delete('/requests/destroy-all', [ProductRequestController::class, 'destroyAll'])
        ->name('requests.destroyAll');
    
    // Edit & Delete Requests
    Route::get('/requests/{id}/edit', [ProductRequestController::class, 'edit'])
        ->name('requests.edit');
    
    Route::put('/requests/{id}', [ProductRequestController::class, 'update'])
        ->name('requests.update');
    
    Route::delete('/requests/{id}', [ProductRequestController::class, 'destroy'])
        ->name('requests.destroy');

    // Export
    Route::get('/export/request', [ExportController::class, 'exportRequest'])
        ->name('export.request');

    Route::get('/export/product', [ExportController::class, 'exportProduct'])
        ->name('export.product');

    Route::delete('/products/bulk-delete', [ProductController::class, 'bulkDestroy'])
        ->name('products.bulkDestroy');
    
    Route::delete('/products/destroy-all', [ProductController::class, 'destroyAll'])
        ->name('products.destroyAll');

    // CRUD Product (tanpa index, karena sudah ada inventory-dashboard)
    Route::resource('products', ProductController::class)->except(['index']);
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
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/user-informasi', [UserController::class, 'index'])->name('user-informasi');
    Route::post('/user-informasi', [UserController::class, 'store'])->name('users.store');
    Route::put('/user-informasi/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/user-informasi/{id}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::delete('/user-informasi/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
Route::get('/inventory-dashboard', [ProductController::class, 'inventoryDashboard'])->middleware('auth')->name('inventory-dashboard');
Route::get('/stock-minim', [ProductController::class, 'stockMinim'])->middleware('auth')->name('stock-minim');
Route::get('/inventory-items', fn() => view('pages.inventory-items'))->name('inventory-items');
Route::middleware(['auth'])->group(function () {
    Route::get('/inventory-movements', [InventoryMovementController::class, 'index'])->name('inventory-movements');
    
    // Edit & Delete Movements (Admin only)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/inventory-movements/{id}/edit', [InventoryMovementController::class, 'edit'])
            ->name('movements.edit');
        
        Route::put('/inventory-movements/{id}', [InventoryMovementController::class, 'update'])
            ->name('movements.update');
        
        Route::delete('/inventory-movements/{id}', [InventoryMovementController::class, 'destroy'])
            ->name('movements.destroy');
        
        Route::delete('/inventory-movements/bulk-delete', [InventoryMovementController::class, 'bulkDestroy'])
            ->name('movements.bulkDestroy');
        
        Route::delete('/inventory-movements/destroy-all', [InventoryMovementController::class, 'destroyAll'])
            ->name('movements.destroyAll');
    });
});
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
