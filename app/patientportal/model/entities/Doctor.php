<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;

use  Eloquent;

/**
 * Class Doctor
 * 
 * @property int $id
 * @property int $doctor_id
 * @property string $name
 * @property string $address
 * @property int $city
 * @property int $country
 * @property string $designation
 * @property string $did
 * @property string $telephone
 * @property string $email
 * @property string $qualifications
 * @property string $specialty
 * @property int $experience
 * @property string $doctor_photo
 * @property string $created_by
 * @property string $updated_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Doctor extends Eloquent
{
	protected $table = 'doctor';

	protected $casts = [
		'doctor_id' => 'int',
		'city' => 'int',
		'country' => 'int',
		'experience' => 'int'
	];

	protected $fillable = [
		'doctor_id',
		'name',
		'address',
		'city',
		'country',
		'designation',
		'did',
		'telephone',
		'email',
		'qualifications',
		'specialty',
		'experience',
		'doctor_photo',
		'created_by',
		'updated_by'
	];

	public function city()
	{
		return $this->belongsTo(\App\Models\City::class, 'city');
	}

	public function country()
	{
		return $this->belongsTo(\App\Models\Country::class, 'country');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'doctor_id');
	}
}
