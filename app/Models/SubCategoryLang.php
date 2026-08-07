<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryLang extends Model
{
    protected $table = 'subcategory_lang';
    public $timestamps = false;


    protected $fillable = [
        'lang_id',
        'subcategory_id',
        'subcategory_name',
        'page_alias',
        'meta_title',
        'meta_keywords',
        'meta_desc',
        'itemprop_headline',
        'itemprop_keywords',
        'itemprop_desc',
        'title_h1',
        'title_h2',
        'page_desc',
    ];
}
