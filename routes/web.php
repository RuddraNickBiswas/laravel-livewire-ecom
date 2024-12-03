<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});


Route::middleware('applyFnLayout')->group(function () {
    Route::get('/', \App\Livewire\Fn\Home\Page::class)->name('home');
    Route::get('/index', \App\Livewire\Fn\Home\Index\Page::class)->name('index');
    Route::get('/show', \App\Livewire\Fn\Home\Show\Page::class)->name('show');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::get('/admin/login', \App\Livewire\Admin\Auth\Login::class)
// ->middleware('guest')
// ->name('admin.login');
