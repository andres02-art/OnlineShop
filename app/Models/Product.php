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
            'prom',
            'mark',
            'company',
            'category_id',
            'promotion_id',
        ]
