<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=
        [
            'favorite',
            'date_liked',
            'liked',
            'pin_board',
            'owner_user_id',
            'customer_user_id',
            'product_id',
        ];
}
