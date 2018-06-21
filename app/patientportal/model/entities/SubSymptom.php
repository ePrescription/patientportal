<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SubSymptom
 * 
 * @property int $id
 * @property string $sub_symptom_name
 * @property string $sub_symptom_code
 * @property int $main_symptom_id
 * @property int $status
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\MainSymptom $main_symptom
 * @property \Illuminate\Database\Eloquent\Collection $patients
 * @property \Illuminate\Database\Eloquent\Collection $patient_symptoms
 * @property \Illuminate\Database\Eloquent\Collection $symptoms
 *
 * @package App\Models
 */
class SubSymptom extends Eloquent
{
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'main_symptom_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'sub_symptom_name',
		'sub_symptom_code',
		'main_symptom_id',
		'status',
		'created_by',
		'modified_by'
	];

	public function main_symptom()
	{
		return $this->belongsTo(\App\Models\MainSymptom::class);
	}

	public function patients()
	{
		return $this->hasMany(\App\Models\Patient::class, 'sub_symptoms_id');
	}

	public function patient_symptoms()
	{
		return $this->hasMany(\App\Models\PatientSymptom::class);
	}

	public function symptoms()
	{
		return $this->hasMany(\App\Models\Symptom::class);
	}
}
