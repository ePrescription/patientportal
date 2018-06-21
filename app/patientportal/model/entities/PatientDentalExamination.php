<?php

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class PatientDentalExamination extends Model
{
    protected $table = 'patient_dental_examination';

    public function dentalexaminationitems()
    {
        return $this->hasMany('App\patientportal\modal\PatientDentalExaminationItems', 'patient_dental_examination_id');
    }
}
