<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class Product extends Model
{
    use HasUlids;
    //
    protected $table = "products";

    public function prices(){
        return $this->hasMany(ProductPrice::class, 'product_id');
    }

}
