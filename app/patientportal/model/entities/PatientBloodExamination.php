<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;

use Illuminate\Database\Eloquent\Model;

class PatientBloodExamination extends Model
{
    protected $table = 'patient_blood_examination';

    public function bloodexaminationitems()
    {
        return $this->hasMany('App\patientportal\modal\PatientBloodExaminationItems', 'patient_blood_examination_id');
    }
}

