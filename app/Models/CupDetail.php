<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['cup_id', 'product_id', 'quantity'])]
#[Appends(['sub_total'])]

class CupDetail extends Model
{
    //
    
    protected $table = 'cup_details';

    public function cup(){
        return $this->belongsTo(Cup::class, 'cup_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getSubTotalAttribute(){
        return $this->product->current_price * $this->quantity;
    }
}
