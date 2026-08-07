<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;


    protected $fillable = [
        'id',
        'category_image',
        'category_status',
        'order_number',
        'alias',
        'icon',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lang()
    {
        return $this->hasMany(CategoryLang::class, 'category_id', 'id');
    }
}
