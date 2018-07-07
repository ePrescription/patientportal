<?php
/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 7/6/18
 * Time: 3:29 PM
 */

namespace App\patientportal\modal;


use Illuminate\Database\Eloquent\Model;

class SecondOpinionItems extends Model
{
    protected $table = 'patient_second_opinion_documents';

    public function patientSecondOpinion()
    {
        return $this->belongsTo('App\patientportal\modal\SecondOpinion', 'patient_second_opinion_documents_patient_second_opinion_id');
    }
}