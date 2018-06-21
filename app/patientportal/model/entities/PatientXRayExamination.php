<?php

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class PatientXRayExamination extends Model
{
    protected $table = 'patient_xray_examination';

    public function xrayexaminationitems()
    {
        return $this->hasMany('App\patientportal\modal\PatientXRayExaminationItems', 'patient_xray_examination_id');
    }
}
