<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElementLang extends Model
{
    protected $table = 'element_lang';
    public $timestamps = false;


    protected $fillable = [
        'lang_id',
        'element_id',
        'element_name',
        'element_desc',
    ];
}
