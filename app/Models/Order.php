<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Guarded(['id'])]
#[Appends(['total_harga', 'status'])]
class Order extends Model
{
    //
    use HasUlids, SoftDeletes, HasFactory;
    protected $table = 'orders';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details(){
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function getTotalHargaAttribute(){
        return $this->details->sum('sub_total');
    }

    public function getStatusAttribute(): string{
        if($this->diterima_pada) return 'Selesai';
        if($this->dikirim_pada) return 'Sedang dikirim';
        if($this->diproses_pada) return 'Diproses';

        return 'Dipesan';
    }

    public function scopeToday(): Builder{
        return $this->whereDate('created_at', today());
    }

    public function scopeSelesai(): Builder{
        return $this->whereNotNull('diterima_pada');
    }
}
