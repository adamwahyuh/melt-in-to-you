<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PagesController::class, 'index'])->name('index');

Route::get('/login', [PagesController::class, 'loginPage'])->middleware('guest')->name('page.login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('post.login');
Route::get('/register', [PagesController::class, 'registerPage'])->middleware('guest')->name('page.register');
Route::post('/register', [AuthController::class, 'resgister'])->middleware('guest')->name('post.register');
Route::post('/logut', [AuthController::class, 'logout'])->middleware('auth')->name('post.logout');

Route::prefix('/dashboard')->middleware(['can:kasir', 'can:owner', 'can:stocker'])->group(function(){
    Route::get('/', [PagesController::class, 'dashboardPage'])->name('page.dashboard.index');

    Route::prefix('/kasir')->middleware('can:kasir')->group(function(){
        Route::get('/', [PagesController::class, 'kasirIndexPage'])->name('page.dashboard.kasir.index');
    });

    Route::prefix('/stocker')->middleware('can:stocker')->group(function(){
        Route::get('/', [PagesController::class, 'stockerIndexPage'])->name('page.dashboard.stocker.index');

        Route::post('/tambah_menu', [ProductController::class, 'store'])->name('post.product.store');
        Route::put('/update_product/{product}', [ProductController::class,'update'])->name('put.product.update');
        Route::post('/update_harga/{product}', [ProductController::class, 'updatePrice'])->name('post.product.update_price');

        Route::delete('/delete_product/{product}', [ProductController::class,'delete'])->name('delete.product.delete');

    });

    Route::prefix('/owner')->middleware('can:owner')->group(function(){
        Route::get('/', [PagesController::class, 'ownerIndexPage'])->name('page.dashboard.owner.index');
    });
});