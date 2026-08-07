<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $table = 'products_has_colors';
    public $timestamps = false;

    protected $fillable = [
        'products_id',
        'color_id',
    ];
}
