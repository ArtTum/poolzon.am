<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategory';
    public $timestamps = false;


    protected $fillable = [
        'id',
        'category_id',
        'subcategory_image',
        'category_id',
        'is_hidden',
        'sort_number',
        'is_block_visible'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lang()
    {
        return $this->hasMany(SubCategoryLang::class, 'subcategory_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|\Illuminate\Database\Query\Builder
     */
    public function category(){
        return $this->hasOne(Category::class,'id','category_id')
            ->leftJoin('category_lang','category_lang.category_id','=','category.id')
            ->leftJoin('lang', 'category_lang.lang_id', 'lang.id')
            ->where('lang.iso', 'ru');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elementCategories()
    {
        return $this->hasMany(ElementCategory::class, 'category_id', 'id');
    }
}
