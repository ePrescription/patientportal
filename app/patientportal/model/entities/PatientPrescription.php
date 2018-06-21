<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PatientPrescription
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $hospital_id
 * @property int $doctor_id
 * @property string $unique_id
 * @property string $brief_description
 * @property string $drug_history
 * @property \Carbon\Carbon $prescription_date
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $prescription_details
 *
 * @package App\Models
 */
class PatientPrescription extends Eloquent
{
	protected $table = 'patient_prescription';

	protected $casts = [
		'patient_id' => 'int',
		'hospital_id' => 'int',
		'doctor_id' => 'int'
	];

	protected $dates = [
		'prescription_date'
	];

	protected $fillable = [
		'patient_id',
		'hospital_id',
		'doctor_id',
		'unique_id',
		'brief_description',
		'drug_history',
		'prescription_date',
		'created_by',
		'modified_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'patient_id');
	}

	public function prescription_details()
	{
		return $this->hasMany(\App\Models\PrescriptionDetail::class);
	}
}
