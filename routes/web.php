<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('components.layouts.app');
});
Route::get('/login', function() 
{
    return redirect('/admin');
})->name('login');
