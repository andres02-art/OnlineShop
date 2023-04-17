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
            'car_id',
            'owner_user_id',
            'product_id',
            'amount',
        ];


    public function Product(){
        return $this->belongsTo(Product::class);
    }

    public function OwnerUser(){
        return $this->hasOne(User::class);
    }

    public function Shops(){
        return $this->hasMany(Shop::class);
    }

    public function Car(){
        return $this->belongsTo(Car::class);
    }
}
