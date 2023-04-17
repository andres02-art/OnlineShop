<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=
        [
            'precio',
            'catalogo',
            'description',
            'img',
            'name',
            'stock',
            'prom',
            'mark',
            'company',
            'category_id',
            'promotion_id',
        ];

    protected $casts=[
        'prom'=>'string'
    ];



    public function Promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Facture(){
        return $this->hasOne(Facture::class);
    }

    public function setPromAttribute($value){
        $this->attributes['prom']=$value?0:1;
    }

}
