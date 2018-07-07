<?php
namespace  App\patientportal\modal;
/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 7/6/18
 * Time: 2:49 PM
 */

use Illuminate\Database\Eloquent\Model;

class AskQuestionDocumentItems extends Model
{
    protected $table = 'patient_ask_question_documents';

    public function patientQuestions()
    {
        return $this->belongsTo('App\patientportal\modal\Askquestion', 'patient_ask_question_documents_id');
    }
}
