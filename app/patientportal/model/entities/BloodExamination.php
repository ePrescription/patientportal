<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;


use Illuminate\Database\Eloquent\Model;


class BloodExamination extends Model
{
    protected $table = 'blood_examination';

    public function patients()
    {
        return $this->belongsToMany('App\patientportal\modal\User', 'patient_blood_examination', 'blood_examination_id', 'patient_id');
    }
}


