<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    public $timestamps = false;
    protected $table = 'appointments';
    protected $fillable = [
        'id',
        'appointment_status',
        'order_number',
    ];

    /**
     * @return HasMany
     */
    public function lang()
    {
        return $this->hasMany(AppointmentLang::class, 'appointment_id', 'id');
    }
}
