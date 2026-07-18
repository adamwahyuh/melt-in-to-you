<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Guarded(['id'])]
#[Appends(['current_price', 'foto_url'])]
class Product extends Model
{
    use HasUlids, SoftDeletes;
    //
    protected $table = "products";

    public function prices(){
        return $this->hasMany(ProductPrice::class, 'product_id');
    }

    public function getCurrentPriceAttribute(){
        return $this->prices()->latest()->value('harga_dalam_rupiah');
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->is_default) {
            return asset($this->foto);
        }

        return asset('storage/' . $this->foto);
    }

}
