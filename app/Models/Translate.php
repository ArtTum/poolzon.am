<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
    protected $table = 'translate';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'key',
        'text',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lang()
    {
        return $this->hasMany(TranslateLang::class, 'translate_id', 'id');
    }
}
