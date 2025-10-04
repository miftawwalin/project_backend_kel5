<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\AuthController;   
use App\Http\Controllers\RequestProductController; 

// ----------------- Authentication -----------------
Route::get('/', function () {
    return redirect()->route('login'); 
});

Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

// ----------------- Dashboard (wajib login) -----------------
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\ProductController::class, 'index']);
});


    // ----------------- Product Resource Route -----------------
    Route::resource('products', ProductController::class);
    Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');
    Route::get('/add-product', function () {
        return view('pages.add-product');
    })->name('add-product');

    // ----------------- Request Barang -----------------
    Route::resource('requests', RequestController::class);

    // 
    Route::middleware('role:user')->group(function(){
        Route::get('/requests/create',[RequestController::class,'create'])->name('requests.create');
        Route::post('/requests',[RequestController::class,'store'])->name('requests.store');
        Route::get('/requests/user',[RequestController::class,'userIndex'])->name('requests.user');

        Route::get('/user/dashboard', function(){
            return view('dashboard_user');
        })->name('user.dashboard');
    });

    // ✅ khusus admin
    Route::middleware('role:admin')->group(function(){
        Route::get('/requests/admin',[RequestController::class,'index'])->name('requests.index');
        Route::post('/requests/{id}/approve',[RequestController::class,'approve'])->name('requests.approve');
        Route::post('/requests/{id}/reject',[RequestController::class,'reject'])->name('requests.reject');

        Route::get('/dashboard', function () {
            if (Auth::check()) {
                return Auth::user()->role === 'admin'
                    ? redirect()->route('admin.dashboard')
                    : redirect()->route('user.dashboard');
            }
            return redirect()->route('login');
        })->name('dashboard');

        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard_admin'); // sesuaikan dengan file view kamu
        })->name('admin.dashboard');
    });

    // ----------------- Stock Information -----------------
    Route::get('/informasi-stock', fn()=>view('pages.informasi-stock'))->name('informasi-stock');

    // ----------------- User Information -----------------
    Route::get('/user-informasi', fn()=>view('pages.user-informasi'))->name('user-informasi');

    // ----------------- Inventory Management -----------------
    Route::get('/inventory-dashboard', fn()=>view('pages.inventory-dashboard'))->name('inventory-dashboard');
    Route::get('/inventory-items', fn()=>view('pages.inventory-items'))->name('inventory-items');
    Route::get('/inventory-movements', fn()=>view('pages.inventory-movements'))->name('inventory-movements');
    Route::get('/inventory-reports', fn()=>view('pages.inventory-reports'))->name('inventory-reports');

    // ----------------- About -----------------
    Route::get('/about', fn()=>view('pages.about'))->name('about');

    // ----------------- Contact -----------------
    Route::get('/contact', fn()=>view('pages.contact'))->name('contact');

