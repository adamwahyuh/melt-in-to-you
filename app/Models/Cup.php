<?php

namespace App\Models;

use App\Models\CupDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
#[Appends(['total_harga'])]
class Cup extends Model
{
    use HasUlids;
    //
    protected $table = 'cups';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function details(){
        return $this->hasMany(CupDetail::class, 'cup_id');
    }

    public function getTotalHargaAttribute(){
        return $this->details->sum('sub_total');
    }
}
