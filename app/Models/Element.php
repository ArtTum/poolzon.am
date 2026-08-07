<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $table = 'element';
    public $timestamps = false;


    protected $fillable = [
        'id',
        'element_type_id',
        'element_url',
        'element_image',
        'rank_source_url',
        'rank_score',
        'rank_last_update',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lang()
    {
        return $this->hasMany(ElementLang::class, 'element_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class,'element_category');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class,'element_subcategory');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function elementType()
    {
        return $this->belongsTo(ElementType::class,'element_type_id');
    }

}
