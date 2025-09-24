<?php

use App\Http\Controllers\product;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', function () {
    return view('pages.dashboard');
})->name('dashboard');

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

// About
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Contact
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/product',[ProductController::class,'index']);
Route:get('/register')