<?php

namespace App\patientportal\modal;


use Illuminate\Database\Eloquent\Model;

class PatientUltrasoundExamination extends Model
{
    protected $table = 'patient_ultra_sound';

    public function ultrasoundexaminationitems()
    {
        return $this->hasMany('App\patientportal\modal\PatientUltrasoundExaminationItems', 'patient_ultra_sound_id');
    }
}
