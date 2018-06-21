<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace  App\patientportal\modal;

use Eloquent;

/**
 * Class Lab
 * 
 * @property int $id
 * @property int $lab_id
 * @property string $name
 * @property string $address
 * @property int $city
 * @property int $country
 * @property string $pincode
 * @property string $lid
 * @property string $telephone
 * @property string $email
 * @property string $lab_photo
 * @property string $created_by
 * @property string $updated_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $lab_labtests
 *
 * @package App\Models
 */
class Lab extends Eloquent
{
	protected $table = 'lab';

	protected $casts = [
		'lab_id' => 'int',
		'city' => 'int',
		'country' => 'int'
	];

	protected $fillable = [
		'lab_id',
		'name',
		'address',
		'city',
		'country',
		'pincode',
		'lid',
		'telephone',
		'email',
		'lab_photo',
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
		return $this->belongsTo(\App\Models\User::class, 'lab_id');
	}

	public function lab_labtests()
	{
		return $this->hasMany(\App\Models\LabLabtest::class);
	}
}
