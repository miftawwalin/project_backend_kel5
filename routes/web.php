<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', function () {
    return view('pages.dashboard');
})->name('dashboard');

// About
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Contact
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
