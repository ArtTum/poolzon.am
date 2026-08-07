<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageLang extends Model
{
    protected $table = 'pages_has_lang';
    public $timestamps = false;


    protected $fillable = [
        'lang_id',
        'page_id',
        'page_name',
        'page_description',
        'meta_title',
        'meta_keys',
        'meta_description',
    ];
}
