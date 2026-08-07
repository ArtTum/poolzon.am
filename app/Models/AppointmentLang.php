<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentLang extends Model
{
    public $timestamps = false;
    protected $table = 'appointments_has_lang';
    protected $fillable = [
        'appointment_id',
        'lang_id',
        'appointment_name',
    ];
}
