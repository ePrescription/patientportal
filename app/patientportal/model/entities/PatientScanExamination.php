<?php

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class PatientScanExamination extends Model
{
    protected $table = 'patient_scan';

    public function scanexaminationitems()
    {
        return $this->hasMany('App\patientportal\modal\PatientScanExaminationItems', 'patient_scan_id');
    }
}
