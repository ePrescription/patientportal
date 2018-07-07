<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace  App\patientportal\modal;

use  Eloquent;

/**
 * Class Doctor
 * 
 * @property int $id
 * @property int $doctor_id
 * @property string $name
 * @property string $address
 * @property int $city
 * @property int $country
 * @property string $designation
 * @property string $did
 * @property string $telephone
 * @property string $email
 * @property string $qualifications
 * @property string $specialty
 * @property int $experience
 * @property string $doctor_photo
 * @property string $created_by
 * @property string $updated_by
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Askquestion extends Eloquent
{
	protected $table = 'patient_ask_question';

	protected $casts = [
		'doctor_id' => 'int',
		'hospital_id' => 'int',
		'patient_id' => 'int'
	];

	protected $fillable = [
		'doctor_id',
		'hospital_id',
		'patient_id',
		'priority_id',
        'specialty_id',
		'subject',
		//'message',
        'question_type',
		'created_by',
		'modified_by'
	];

	
}
