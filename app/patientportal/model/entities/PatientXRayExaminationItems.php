<?php

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class PatientXRayExaminationItems extends Model
{
    protected $table = 'patient_xray_examination_item';

    public function xrayexamination()
    {
        return $this->belongsTo('App\patientportal\modal\PatientXRayExamination', 'patient_xray_examination_id');
    }
}
