<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;

use  Eloquent;

/**
 * Class PatientUltraSound
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $ultra_sound_id
 * @property \Carbon\Carbon $examination_date
 * @property int $is_value_set
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 * @property \App\Models\UltraSound $ultra_sound
 *
 * @package App\Models
 */
class PatientUltraSound extends Eloquent
{
	protected $table = 'patient_ultra_sound';

	protected $casts = [
		'patient_id' => 'int',
		'ultra_sound_id' => 'int',
		'is_value_set' => 'int'
	];

	protected $dates = [
		'examination_date'
	];

	protected $fillable = [
		'patient_id',
		'ultra_sound_id',
		'examination_date',
		'is_value_set',
		'created_by',
		'modified_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'patient_id');
	}

	public function ultra_sound()
	{
		return $this->belongsTo(\App\Models\UltraSound::class);
	}
}
