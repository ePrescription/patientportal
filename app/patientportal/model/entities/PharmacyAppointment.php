<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;

use  Eloquent;

/**
 * Class DoctorAppointment
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $hospital_id
 * @property int $doctor_id
 * @property string $brief_history
 * @property \Carbon\Carbon $appointment_date
 * @property \Carbon\Carbon $appointment_time
 * @property int $appointment_type
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class PharmacyAppointment extends Eloquent
{
	protected $table = 'pharmacy_pickup';

	protected $casts = [
		'patient_id' => 'int',
		'hospital_id' => 'int',
		'pharmacy_id' => 'int',
		'appointment_type' => 'int'
	];

	protected $dates = [
		'appointment_date',
		'appointment_time'
	];

	protected $fillable = [
		'patient_id',
		'hospital_id',
		'pharmacy_id',
		'briefnote',
        'doctor_name',
		'appointment_date',
		'appointment_time',
		'appointment_type',
		'created_by',
		'modified_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'patient_id');
	}
}
