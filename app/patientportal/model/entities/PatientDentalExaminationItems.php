<?php

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class PatientDentalExaminationItems extends Model
{
    protected $table = 'patient_dental_examination_item';

    public function dentalexamination()
    {
        return $this->belongsTo('App\patientportal\model\PatientDentalExamination', 'patient_dental_examination_id');
    }
}
