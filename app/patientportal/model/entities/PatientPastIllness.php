<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PatientPastIllness
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $past_illness_id
 * @property string $past_illness_name
 * @property string $relation
 * @property int $is_value_set
 * @property \Carbon\Carbon $past_illness_date
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\PastIllness $past_illness
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class PatientPastIllness extends Eloquent
{
	protected $table = 'patient_past_illness';

	protected $casts = [
		'patient_id' => 'int',
		'past_illness_id' => 'int',
		'is_value_set' => 'int'
	];

	protected $dates = [
		'past_illness_date'
	];

	protected $fillable = [
		'patient_id',
		'past_illness_id',
		'past_illness_name',
		'relation',
		'is_value_set',
		'past_illness_date',
		'created_by',
		'modified_by'
	];

	public function past_illness()
	{
		return $this->belongsTo(\App\Models\PastIllness::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'patient_id');
	}
}
