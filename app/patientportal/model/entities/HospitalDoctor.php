<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;

use  Eloquent;

/**
 * Class HospitalDoctor
 * 
 * @property int $id
 * @property int $hospital_id
 * @property int $doctor_id
 * @property string $created_by
 * @property string $updated_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class HospitalDoctor extends Eloquent
{
	protected $table = 'hospital_doctor';

	protected $casts = [
		'hospital_id' => 'int',
		'doctor_id' => 'int'
	];

	protected $fillable = [
		'hospital_id',
		'doctor_id',
		'created_by',
		'updated_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'hospital_id');
	}
        public function hospital()
        {
            return $this->hasMany(\App\Hospital::class, 'hospital_id');
        }
}
