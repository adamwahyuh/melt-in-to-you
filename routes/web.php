<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CupController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PagesController::class, 'index'])->name('index');

Route::get('/login', [PagesController::class, 'loginPage'])->middleware('guest')->name('page.login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('post.login');
Route::get('/register', [PagesController::class, 'registerPage'])->middleware('guest')->name('page.register');
Route::post('/register', [AuthController::class, 'resgister'])->middleware('guest')->name('post.register');
Route::post('/logut', [AuthController::class, 'logout'])->middleware('auth')->name('post.logout');

Route::prefix('cup')->group(function(){
    Route::get('/', [PagesController::class, 'cupPage'])->name('page.cup.index');
    Route::post('/', [CupController::class, 'storeToCup'])->name('post.cup.store_to_cup');
    Route::post('/{detail}', [CupController::class, 'subtractOneFromCup'])->name('post.cup.subtract_one_from_cup');
    Route::delete('/{detail}', [CupController::class, 'deleteCupDetail'])->name('delete.cup.delete_cup_detail');
});

Route::prefix('/>_<')->middleware(['can:kasir', 'can:owner', 'can:stocker'])->group(function(){
    Route::get('/', [PagesController::class, 'dashboardPage'])->name('page.dashboard.index');

    Route::prefix('/kasir')->middleware('can:kasir')->group(function(){
        Route::get('/', [PagesController::class, 'kasirIndexPage'])->name('page.dashboard.kasir.index');
    });

    Route::prefix('/stocker')->middleware('can:stocker')->group(function(){
        Route::get('/', [PagesController::class, 'stockerIndexPage'])->name('page.dashboard.stocker.index');
        
        Route::get('/tambah_menu', [PagesController::class, 'createProductPage'])->name('page.product.create');

        Route::post('/tambah_menu', [ProductController::class, 'store'])->name('post.product.store');
        Route::get('/edit/{product}', [PagesController::class, 'editProductPage'])->name('page.product.edit');
        
        Route::put('/update_product/{product}', [ProductController::class,'updateProduct'])->name('put.product.update');
        Route::post('/update_harga/{product}', [ProductController::class, 'updateHarga'])->name('post.product.update_price');
        Route::delete('/delete_product/{product}', [ProductController::class,'deleteProduct'])->name('delete.product.delete');
    });

    Route::prefix('/owner')->middleware('can:owner')->group(function(){
        Route::get('/', [PagesController::class, 'ownerIndexPage'])->name('page.dashboard.owner.index');
    });
});