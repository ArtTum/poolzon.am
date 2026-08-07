<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
    public $timestamps = false;


    protected $fillable = [
        'id',
        'page_status',
        'order_number',
        'alias',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lang()
    {
        return $this->hasMany(PageLang::class, 'page_id', 'id');
    }
}
