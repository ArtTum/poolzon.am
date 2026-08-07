<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickSearchLang extends Model
{
    protected $table = 'quick_search_lang';
    public $timestamps = false;


    protected $fillable = [
        'lang_id',
        'quick_search_id',
        'quick_search_name',
        'quick_search_alias',
    ];
}
