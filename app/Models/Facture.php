<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=
        [
            'sub_total',
            'total_purchase',
            'method',
            'token',
            'type_id',
            'user_id',
            'car_id',
            'product_id',
        ];
}
