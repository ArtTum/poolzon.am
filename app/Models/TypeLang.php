<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeLang extends Model
{
    public $timestamps = false;
    protected $table = 'types_has_lang';
    protected $fillable = [
        'type_id',
        'lang_id',
        'type_name',
    ];
}
