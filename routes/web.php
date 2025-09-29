<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestController;


// Dashboard
Route::get('/', function () {
    return view('pages.dashboard');
})->name('dashboard');

// Product Resource Route
Route::resource('products', ProductController::class);

// Route khusus untuk form tambah produk dari folder pages
Route::get('/add-product', function () {
    return view('pages.add-product');
})->name('add-product');
//
Route::resource('requests', RequestController::class);
// Form Request User
Route::get('/form-request-user', function () {
    return view('pages.form-request-user');
})->name('form-request-user');

// Stock Information
Route::get('/informasi-stock', function () {
    return view('pages.informasi-stock');
})->name('informasi-stock');

// User Information
Route::get('/user-informasi', function () {
    return view('pages.user-informasi');
})->name('user-informasi');

// Inventory Management Routes
Route::get('/inventory-dashboard', function () {
    return view('pages.inventory-dashboard');
})->name('inventory-dashboard');

Route::get('/inventory-items', function () {
    return view('pages.inventory-items');
})->name('inventory-items');

Route::get('/inventory-movements', function () {
    return view('pages.inventory-movements');
})->name('inventory-movements');

Route::get('/inventory-reports', function () {
    return view('pages.inventory-reports');
})->name('inventory-reports');

// About
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Contact
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
