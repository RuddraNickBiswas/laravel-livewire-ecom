<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/trigger-event', function () {
    broadcast(new \App\Events\ExampleEvent());
    return 'Event has been broadcast!';
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

Route::get('/admin/login', \App\Livewire\Admin\Auth\Login::class)
->middleware('guest')
->name('admin.login');
