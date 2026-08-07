<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'alias',
        'product_image',
        'price',
        'sale',
        'bestseller',
        'number_mounting_holes',
        'product_code',
        'category_id',
        'types_id',
        'appointment_id',
        'brand_id',
        'product_count',
    ];

    public function lang(){
        return $this->hasMany(ProductLang::class, 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function colorshas(){
        return $this->belongsToMany(Color::class, 'products_has_colors', 'products_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function colors(){
        return $this->hasMany(ProductColor::class, 'products_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type(){
        return $this->hasOne(Type::class, 'id', 'types_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function brand(){
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function appointment(){
        return $this->hasOne(Appointment::class, 'id', 'appointment_id');
    }
}
