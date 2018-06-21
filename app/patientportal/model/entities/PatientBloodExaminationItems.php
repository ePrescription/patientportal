<?php

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class PatientBloodExaminationItems extends Model
{
    protected $table = 'patient_blood_examination_item';

    public function bloodexamination()
    {
        return $this->belongsTo('App\patientportal\modal\PatientBloodExamination', 'patient_blood_examination_id');
    }

}
