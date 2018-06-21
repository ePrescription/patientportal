<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace  App\patientportal\modal;

use  Eloquent;

/**
 * Class HospitalLab
 * 
 * @property int $id
 * @property int $hospital_id
 * @property int $lab_id
 * @property string $created_by
 * @property string $updated_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class HospitalLab extends Eloquent
{
	protected $table = 'hospital_lab';

	protected $casts = [
		'hospital_id' => 'int',
		'lab_id' => 'int'
	];

	protected $fillable = [
		'hospital_id',
		'lab_id',
		'created_by',
		'updated_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'lab_id');
	}
}
