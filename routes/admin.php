<?php

use Illuminate\Support\Facades\Route;



Route::get('/dashboard',\App\Livewire\Admin\Dashboard\Page::class)->name('dashboard');

Route::get('/test',App\Livewire\Admin\Test\Page::class)->name('test');

