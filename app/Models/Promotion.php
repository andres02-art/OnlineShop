<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'name',
        'season',
        'active',
        'sale',
        'date_begin',
        'date_end'
    ];

    protected $casts=[
        'active'=>'string'
    ];

    public function Products()
    {
        return $this->hasMany(Product::class);
    }

    public function setActiveAttribute($value)
    {
        $this->attributes['active']=$value? 1 : 0;
    }
}
