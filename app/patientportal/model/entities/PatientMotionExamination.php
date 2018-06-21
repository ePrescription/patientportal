<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class PatientMotionExamination extends Model
{
    protected $table = 'patient_motion_examination';

    public function motionexaminationitems()
    {
        return $this->hasMany('App\patientportal\modal\PatientMotionExaminationItems', 'patient_motion_examination_id');
    }
}

