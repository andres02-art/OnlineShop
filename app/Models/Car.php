<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'sub_total',
        'total_purchase',
        'owner_user_id',
    ];

    public function Factures(){
        return $this->hasMany(Facture::class);
    }
}
