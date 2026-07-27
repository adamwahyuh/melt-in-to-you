<?php

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function(){
    return response()->json(['ping' => 'pong']);
});

