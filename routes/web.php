<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Tienda publica
Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/producto/{product:slug}', [ShopController::class, 'show'])->name('product.show');

// Carrito
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/carrito/actualizar/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrito/eliminar/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrito/vaciar', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/carrito/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/carrito/count', [CartController::class, 'count'])->name('cart.count');

// Dashboard del cliente
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Panel de Administracion
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('products', ProductController::class)->except('show');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
});

require __DIR__.'/auth.php';
