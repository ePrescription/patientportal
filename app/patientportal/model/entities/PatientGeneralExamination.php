<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PatientGeneralExamination
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $general_examination_id
 * @property string $general_examination_value
 * @property int $is_value_set
 * @property \Carbon\Carbon $general_examination_date
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\GeneralExamination $general_examination
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class PatientGeneralExamination extends Eloquent
{
	protected $table = 'patient_general_examination';

	protected $casts = [
		'patient_id' => 'int',
		'general_examination_id' => 'int',
		'is_value_set' => 'int'
	];

	protected $dates = [
		'general_examination_date'
	];

	protected $fillable = [
		'patient_id',
		'general_examination_id',
		'general_examination_value',
		'is_value_set',
		'general_examination_date',
		'created_by',
		'modified_by'
	];

	public function general_examination()
	{
		return $this->belongsTo(\App\Models\GeneralExamination::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'patient_id');
	}
}
