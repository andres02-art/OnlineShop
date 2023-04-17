<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'owner_user_id',
        'customer_user_id',
        'factures_id',
        'description',
        'shop_confirm',
        'date_shop'
    ];

    public function CustomUsers()
    {
        return $this->belongsTo(User::class);
    }

    public function OwnerUser()
    {
        return $this->belongsTo(User::class);
    }

    public function Factures()
    {
        return $this->belongsTo(Facture::class);
    }
}
