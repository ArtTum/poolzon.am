<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $timestamps = true;


    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'phone',
        'p_first_name',
        'p_last_name',
        'p_phone',
        'city',
        'address',
        'home',
        'entrance',
        'floor',
        'intercom',
        'comment',
        'products',
        'status',
        'error',
        'total_count',
        'total_price',
        'payment_id',
        'type',
    ];
}
