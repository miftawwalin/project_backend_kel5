<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.dashboard');
});

Route::get('/about', function(){
    return view ('pages.about');
});

Route::get('/contact', function(){
    return view ('pages.contact');
});