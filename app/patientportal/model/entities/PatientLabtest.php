<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;

use Eloquent;

/**
 * Class PatientLabtest
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $hospital_id
 * @property int $doctor_id
 * @property string $unique_id
 * @property string $brief_description
 * @property \Carbon\Carbon $labtest_date
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $labtest_details
 *
 * @package App\Models
 */
class PatientLabtest extends Eloquent
{
	protected $table = 'patient_labtest';

	protected $casts = [
		'patient_id' => 'int',
		'hospital_id' => 'int',
		'doctor_id' => 'int'
	];

	protected $dates = [
		'labtest_date'
	];

	protected $fillable = [
		'patient_id',
		'hospital_id',
		'doctor_id',
		'unique_id',
		'brief_description',
		'labtest_date',
		'created_by',
		'modified_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\patientportal\modal\User::class, 'patient_id');
	}

	public function labtest_details()
	{
		return $this->hasMany(\App\patientportal\modal\LabtestDetail::class);
	}
}
