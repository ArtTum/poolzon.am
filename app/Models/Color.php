<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    public $timestamps = false;
    protected $table = 'colors';
    protected $fillable = [
        'id',
        'color_status',
        'order_number',
    ];


    /**
     * @return HasMany
     */
    public function lang()
    {
        return $this->hasMany(ColorLang::class, 'color_id', 'id');
    }
}
