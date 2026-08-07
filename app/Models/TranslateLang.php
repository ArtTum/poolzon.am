<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslateLang extends Model
{
    protected $table = 'translate_lang';
    public $timestamps = false;

    protected $fillable = [
        'translate_id',
        'lang_id',
        'text',
    ];
}
