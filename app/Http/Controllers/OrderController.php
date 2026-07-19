<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function transferCupToOrder(){
        $userLoggedId = Auth::id();    
        $user = User::where('id', $userLoggedId)->first();
        
        if(!$user->cup || $user->cup->details->isEmpty()) return back('error', 'Tidak ada produk di dalam cup');

        $order = Order::firstOrCreate(['user_id', $user->id, 'dipesan_pada' => now()]);
        
        foreach($user->cup->details as $detail) {
            $order->details()->create([
                'product_id' => $detail->product_id,
                'quantity' => $detail->quantity,
                'harga_dalam_rupiah' => $detail->product->current_price,
            ]);
        }

        $deleteCup = $user->cup->details()->delete();

        return back()->with('success', 'Produk di Order');
    }
}
