<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MainSymptom
 * 
 * @property int $id
 * @property string $main_symptom_name
 * @property string $main_symptom_code
 * @property int $status
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $patients
 * @property \Illuminate\Database\Eloquent\Collection $patient_symptoms
 * @property \Illuminate\Database\Eloquent\Collection $sub_symptoms
 *
 * @package App\Models
 */
class MainSymptom extends Eloquent
{
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'main_symptom_name',
		'main_symptom_code',
		'status',
		'created_by',
		'modified_by'
	];

	public function patients()
	{
		return $this->hasMany(\App\Models\Patient::class, 'main_symptoms_id');
	}

	public function patient_symptoms()
	{
		return $this->hasMany(\App\Models\PatientSymptom::class);
	}

	public function sub_symptoms()
	{
		return $this->hasMany(\App\Models\SubSymptom::class);
	}
}
