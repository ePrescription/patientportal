<?php

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class DoctorAppointment extends Model
{
    protected $table = 'doctor_appointment';

    public function doctor()
    {
        return $this->belongsTo('App\User', 'doctor_id');
    }
}
