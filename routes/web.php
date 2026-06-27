<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PagesController::class, 'index'])->name('index');

Route::get('/login', [PagesController::class, 'loginPage'])->name('page.login');
Route::post('/login', [AuthController::class, 'login'])->name('post.login');
Route::post('/logut', [AuthController::class, 'logout'])->name('post.logout');