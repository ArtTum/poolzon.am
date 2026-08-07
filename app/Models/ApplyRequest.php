<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyRequest extends Model
{
    protected $table = 'apply_request';
    public $timestamps = false;


    protected $fillable = [
        'id',
        'resource_name',
        'resource_url',
        'category_id',
        'resource_desc',
        'contact_person',
        'email',
        'phone',
        'receive_date',
        'is_processed',
    ];
}
