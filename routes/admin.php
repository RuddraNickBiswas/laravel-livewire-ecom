<?php

use Illuminate\Support\Facades\Route;



Route::get('/dashboard', \App\Livewire\Admin\Dashboard\Page::class)->name('dashboard');

Route::get('/test', App\Livewire\Admin\Test\Page::class)->name('test');
Route::get('/test/{test}', App\Livewire\Admin\Test\Show::class)
->name('test.show');
