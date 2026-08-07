<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdBlocks extends Model
{
    protected $table = 'ad_block';
    public $timestamps = false;


    protected $fillable = [
        'id',
        'ad_block_name',
        'ad_block_code',
        'is_hidden',
    ];
}
