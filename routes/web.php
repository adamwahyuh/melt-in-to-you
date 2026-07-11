<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PagesController::class, 'index'])->name('index');

Route::get('/login', [PagesController::class, 'loginPage'])->middleware('guest')->name('page.login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('post.login');
Route::get('/register', [PagesController::class, 'registerPage'])->middleware('guest')->name('page.register');
Route::post('/register', [AuthController::class, 'resgister'])->middleware('guest')->name('post.register');
Route::post('/logut', [AuthController::class, 'logout'])->middleware('auth')->name('post.logout');

Route::prefix('/dashboard')->middleware(['can:kasir', 'can:owner', 'can:stocker'])->group(function(){
    Route::get('/', [PagesController::class, 'dashboardPage'])->name('page.dashboard.index');
});