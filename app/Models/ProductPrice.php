<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['harga_dalam_rupiah', 'product_id'])]
class ProductPrice extends Model
{
    //
    protected $table = 'product_prices';
}
