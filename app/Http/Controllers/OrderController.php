<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function transferCupToOrder(){
        $userLoggedId = Auth::id();    
        $user = User::with('addresses')->where('id', $userLoggedId)->first();
        
        $activeAddress = $user->addresses()->where('is_active', true)->first();

        if($activeAddress === null) return back('error', 'Tidak ada alamat utama');
        // dd($activeAddress);
        if(!$user->cup || $user->cup->details->isEmpty()) return back('error', 'Tidak ada produk di dalam cup');


        $order = $user->orders()->create([
            'user_id', $user->id, 
            'dipesan_pada' => now(),
            'address_id' => $activeAddress->id,
        ]);
        
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

    public function menandaiDiproses(Order $order){
        $order = $order->update(['diproses_pada' => now()]); 
        return back()->with('success', 'Order ditandai sedang diproses');
    }
    
    public function menandaiDikirim(Order $order){
        $order = $order->update(['dikirim_pada' => now()]);
        return back()->with('success', 'Order ditandai sedang dikirim');
    }

    public function menandaiSelesai(Order $order){
        $userLoggedId = Auth::id();
        
        if (!$order->dikirim_pada || !$order->diproses_pada || !$order->dipesan_pada) return back()->with('error', 'Tidak bisa melakukan ini');

        if($userLoggedId != $order->user_id) return back()->with('error', 'Tidak bisa melakukan ini');

        $order = $order->update(['diterima_pada' => now()]);
        return back()->with('success', 'Order telah selesai');
    }
    
}
