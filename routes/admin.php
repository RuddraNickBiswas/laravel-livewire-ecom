<?php

use Illuminate\Support\Facades\Route;



Route::get('/dashboard', \App\Livewire\Admin\Dashboard\Page::class)->name('dashboard');

Route::get('/test', App\Livewire\Admin\Test\Page::class)->name('test');
Route::get('/test/{test}', App\Livewire\Admin\Test\Show::class)
->name('test.show');


Route::get('/category-group', \App\Livewire\Admin\Dashboard\Page::class)->name('categoryGroup');
Route::get('/category', \App\Livewire\Admin\Category\Index\Page::class)->name('category');
Route::get('/sub-category', App\Livewire\Admin\Test\Show::class)->name('subCategory');


Route::get('/brand', App\Livewire\Admin\Brand\Index\Page::class)->name('brand');
