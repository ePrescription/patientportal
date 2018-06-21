<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace  App\patientportal\modal;

use Eloquent;

/**
 * Class Pharmacy
 * 
 * @property int $id
 * @property int $pharmacy_id
 * @property string $name
 * @property string $address
 * @property int $city
 * @property int $country
 * @property string $phid
 * @property string $telephone
 * @property string $email
 * @property string $pharmacy_photo
 * @property string $created_by
 * @property string $updated_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Pharmacy extends Eloquent
{
	protected $table = 'pharmacy';

	protected $casts = [
		'pharmacy_id' => 'int',
		'city' => 'int',
		'country' => 'int'
	];

	protected $fillable = [
		'pharmacy_id',
		'name',
		'address',
		'city',
		'country',
		'phid',
		'telephone',
		'email',
		'pharmacy_photo',
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
		return $this->belongsTo(\App\Models\User::class, 'pharmacy_id');
	}
}
