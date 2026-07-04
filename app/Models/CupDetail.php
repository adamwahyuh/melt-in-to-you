<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['cup_id', 'product_id', 'quantity'])]
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
}
