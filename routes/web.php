<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //types
    Route::get('types/get', [TypeController::class, 'get'])->name('types.get');
    Route::get('types/create', [TypeController::class, 'create'])->name('types.create');
    Route::post('types/store', [TypeController::class, 'store'])->name('type.store');
    Route::get('type/edit/{id}', [TypeController::class, 'edit'])->name('type.edit');
    Route::get('type/delete/{id}', [TypeController::class, 'destroy'])->name('types.destroy');

    //Products
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('products/get', [ProductController::class, 'get'])->name('products.get');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/profile', [ProfileController::class, 'customer'])->name('customer.profile');
    Route::patch('/customer/profile', [ProfileController::class, 'customerUpdate'])->name('customer.profile.update');
    Route::delete('/customer/profile', [ProfileController::class, 'destroy'])->name('customer.profile.destroy');
});

// Frontend Routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/view/{id}', [HomeController::class, 'home_view'])->name('home.view');
Route::get('/home/add-to-list', [HomeController::class, 'add_to_list'])->name('home.add-to-list');
Route::get('/home/add-to-list/{id}', [HomeController::class, 'store_add_to_list'])->name('home.add-to-list.store');
Route::post('/home/checkout/{id}', [HomeController::class, 'checkout'])->name('home.checkout');

require __DIR__.'/auth.php';
