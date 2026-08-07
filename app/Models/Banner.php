<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'banner_image',
        'banner_url',
        'order_number',
        'banner_status',
    ];
}
