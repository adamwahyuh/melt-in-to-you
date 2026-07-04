<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['dikirim_pada', 'dipesan_pada', 'diproses_pada', 'diterima_pada', 'user_id'])]
class Order extends Model
{
    //
    use HasUlids;
    protected $table = 'orders';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details(){
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
