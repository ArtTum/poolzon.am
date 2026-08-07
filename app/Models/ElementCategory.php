<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElementCategory extends Model
{
    protected $table = 'element_category';
    public $timestamps = false;


    protected $fillable = [
        'element_id',
        'category_id',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lang()
    {
        return $this->hasMany(ElementTypeLang::class, 'element_type_id', 'id');
    }
}
