<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['harga_dalam_rupiah', 'order_id', 'product_id', 'quantity'])]
class OrderDetail extends Model
{
    //
    protected $table = 'order_details';

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
