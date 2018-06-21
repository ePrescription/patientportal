<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PatientSymptom
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $main_symptom_id
 * @property int $sub_symptom_id
 * @property int $symptom_id
 * @property \Carbon\Carbon $patient_symptom_date
 * @property int $is_value_set
 * @property string $created_by
 * @property \Carbon\Carbon $created_at
 * @property string $modified_by
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\MainSymptom $main_symptom
 * @property \App\Models\User $user
 * @property \App\Models\SubSymptom $sub_symptom
 * @property \App\Models\Symptom $symptom
 *
 * @package App\Models
 */
class PatientSymptom extends Eloquent
{
	protected $casts = [
		'patient_id' => 'int',
		'main_symptom_id' => 'int',
		'sub_symptom_id' => 'int',
		'symptom_id' => 'int',
		'is_value_set' => 'int'
	];

	protected $dates = [
		'patient_symptom_date'
	];

	protected $fillable = [
		'patient_id',
		'main_symptom_id',
		'sub_symptom_id',
		'symptom_id',
		'patient_symptom_date',
		'is_value_set',
		'created_by',
		'modified_by'
	];

	public function main_symptom()
	{
		return $this->belongsTo(\App\Models\MainSymptom::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'patient_id');
	}

	public function sub_symptom()
	{
		return $this->belongsTo(\App\Models\SubSymptom::class);
	}

	public function symptom()
	{
		return $this->belongsTo(\App\Models\Symptom::class);
	}
}
