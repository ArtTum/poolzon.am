<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'brand_image',
        'brand_status',
        'order_number',
        'alias',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lang()
    {
        return $this->hasMany(BrandLang::class, 'brand_id', 'id');
    }
}
