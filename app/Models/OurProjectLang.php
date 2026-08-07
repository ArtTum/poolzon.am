<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurProjectLang extends Model
{
    protected $table = 'our_project_has_lang';
    public $timestamps = false;


    protected $fillable = [
        'lang_id',
        'our_project_id',
        'our_project_name',
    ];
}
