<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLang extends Model
{
    protected $table = 'products_has_lang';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'lang_id',
        'product_name',
        'description',
        'advantages',
        'meta_title',
        'meta_keys',
        'meta_description',
    ];
}
