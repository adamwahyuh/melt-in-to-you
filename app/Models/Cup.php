<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id'])]
class Cup extends Model
{
    use HasUlids;
    //
    protected $table = 'cups';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
