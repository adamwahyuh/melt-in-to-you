<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name'])]
class Peran extends Model
{
    //
    protected $table = 'peran'; 

    public function users(){
        return $this->belongsToMany(User::class, 'peran_users', 'peran_id', 'user_id')->withPivot(['name'])->withTimestamps();
    }
}
