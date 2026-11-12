<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

 
Route::middleware(['auth', 'verified'])->group(function () {
    
     
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

     
    Route::resource('products', ProductController::class);

     
    Route::resource('transactions', InventoryTransactionController::class);

     
    Route::resource('brands', BrandController::class);

     
    Route::resource('categories', CategoryController::class);

     
    Route::resource('users', UserController::class);

     
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

     
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';