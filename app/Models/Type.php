<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    public $timestamps = false;
    protected $table = 'types';
    protected $fillable = [
        'id',
        'type_status',
        'order_number',
    ];


    /**
     * @return HasMany
     */
    public function lang()
    {
        return $this->hasMany(TypeLang::class, 'type_id', 'id');
    }
}
