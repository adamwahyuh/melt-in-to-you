<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['cup_id', 'product_id', 'quantity'])]
class CupDetail extends Model
{
    //
    protected $table = 'cup_details';
}
