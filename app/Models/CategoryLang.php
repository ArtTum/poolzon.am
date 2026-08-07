<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryLang extends Model
{
    protected $table = 'categories_has_lang';
    public $timestamps = false;


    protected $fillable = [
        'lang_id',
        'category_id',
        'category_name',
        'meta_title',
        'meta_keys',
        'meta_description',
    ];
}
