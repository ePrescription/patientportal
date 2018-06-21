<?php

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class PatientScanExaminationItems extends Model
{
    protected $table = 'patient_scan_item';

    public function scan()
    {
        return $this->belongsTo('App\patientportal\modal\PatientScanExamination', 'patient_scan_id');
    }
}
