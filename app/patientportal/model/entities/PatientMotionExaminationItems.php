<?php

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class PatientMotionExaminationItems extends Model
{
    protected $table = 'patient_motion_examination_item';

    public function motionexamination()
    {
        return $this->belongsTo('App\patientportal\modal\PatientMotionExamination', 'patient_motion_examination_id');
    }
}
