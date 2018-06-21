<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Symptom
 * 
 * @property int $id
 * @property string $symptom_name
 * @property string $symptom_code
 * @property int $sub_symptom_id
 * @property int $status
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\SubSymptom $sub_symptom
 * @property \Illuminate\Database\Eloquent\Collection $patients
 * @property \Illuminate\Database\Eloquent\Collection $patient_symptoms
 *
 * @package App\Models
 */
class Symptom extends Eloquent
{
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'sub_symptom_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'symptom_name',
		'symptom_code',
		'sub_symptom_id',
		'status',
		'created_by',
		'modified_by'
	];

	public function sub_symptom()
	{
		return $this->belongsTo(\App\Models\SubSymptom::class);
	}

	public function patients()
	{
		return $this->hasMany(\App\Models\Patient::class, 'symptoms_id');
	}

	public function patient_symptoms()
	{
		return $this->hasMany(\App\Models\PatientSymptom::class);
	}
}
