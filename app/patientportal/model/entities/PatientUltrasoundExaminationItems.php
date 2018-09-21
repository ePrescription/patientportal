<?php

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class PatientUltrasoundExaminationItems extends Model
{
    protected $table = 'patient_ultra_sound_item';

    public function ultrasoundexamination()
    {
        return $this->belongsTo('App\patientportal\modal\PatientUltrasoundExamination', 'patient_ultra_sound_id');
    }
}
