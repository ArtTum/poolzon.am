<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElementSubCategory extends Model
{
    protected $table = 'element_subcategory';
    public $timestamps = false;


    protected $fillable = [
        'subcategory_id',
        'element_id',
    ];

}
