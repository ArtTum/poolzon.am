<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $table = 'contact_request';
    public $timestamps = false;


    protected $fillable = [
        'id',
        'contact_person',
        'email',
        'phone',
        'request_text',
        'receive_date',
        'is_processed',
    ];
}
