<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandLang extends Model
{
    protected $table = 'brands_has_lang';
    public $timestamps = false;


    protected $fillable = [
        'lang_id',
        'brand_id',
        'brand_name',
        'meta_title',
        'meta_keys',
        'meta_description',
    ];
}
