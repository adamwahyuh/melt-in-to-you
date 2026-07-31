<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class Address extends Model
{
    //
    use HasFactory;
    protected $table = 'addresses';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
