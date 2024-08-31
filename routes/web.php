<?php

use App\Models\TestTema;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('components.layouts.app');
});
Route::get('/example', function () {
    return view('viewer.example');
});

Route::get('/login', function() 
{
    return redirect('/admin');
})->name('login');
