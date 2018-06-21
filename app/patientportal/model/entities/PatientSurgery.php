<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PatientSurgery
 * 
 * @property int $id
 * @property int $patient_id
 * @property string $patient_surgeries
 * @property \Carbon\Carbon $operation_date
 * @property \Carbon\Carbon $surgery_input_date
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class PatientSurgery extends Eloquent
{
	protected $casts = [
		'patient_id' => 'int'
	];

	protected $dates = [
		'operation_date',
		'surgery_input_date'
	];

	protected $fillable = [
		'patient_id',
		'patient_surgeries',
		'operation_date',
		'surgery_input_date',
		'created_by',
		'modified_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'patient_id');
	}
}
