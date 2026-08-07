<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickSearch extends Model
{
    protected $table = 'quick_search';
    public $timestamps = false;


    protected $fillable = [
        'id',
        'is_hidden',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lang()
    {
        return $this->hasMany(QuickSearchLang::class, 'quick_search_id', 'id');
    }
}
