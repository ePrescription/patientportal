<?php

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class PatientUrineExamination extends Model
{
    protected $table = 'patient_urine_examination';

    public function urineexaminationitems()
    {
        return $this->hasMany('App\patientportal\modal\PatientUrineExaminationItems', 'patient_urine_examination_id');
    }
}
