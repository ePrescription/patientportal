<?php

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class PatientUrineExaminationItems extends Model
{
    protected $table = 'patient_urine_examination_item';

    public function urineexamination()
    {
        return $this->belongsTo('App\patientportal\modal\PatientUrineExamination', 'patient_urine_examination_id');
    }
}
