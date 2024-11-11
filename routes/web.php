<?php

use App\Livewire\DigitalInvitation\InvitationViewer;
use App\Livewire\Home;
use App\Models\DigitalInvitation\Transaction\Invitation;
use App\Models\MiniUrl\Transaction\MiniUrl;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);

// undangan viewer
Route::get('/{slug}', InvitationViewer::class);
// function () {
//     // $data = Invitation::where('slug', '=', request()->segment('1'))->first();
//     // return view('viewer.example', ['data' => $data]);
// });

Route::get('/url/{shortUrl}', function ($shorUrl) {
    $newShortUrl = MiniUrl::where('short_url', '=', $shorUrl)->firstOrFail();
    return redirect()->to($newShortUrl->original_url);
});

// Route::get('/example', function () {
//     return view('viewer.example');
// });

// Route::get('/{slug}', function () {
//     // dd('workz**'.request()->segment('1'));
//     $data = Invitation::where('slug', '=', request()->segment('1'))->first();
//     return view('viewer.example', ['data' => $data]);
// });

// Route::get('/login', function() 
// {
//     return redirect('/admin');
// })->name('login');
