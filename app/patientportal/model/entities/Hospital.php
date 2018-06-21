<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;
use Illuminate\Database\Eloquent\Model;



/**
 * Class Hospital
 * 
 * @property int $id
 * @property int $hospital_id
 * @property string $hospital_name
 * @property string $address
 * @property int $city
 * @property int $country
 * @property string $hid
 * @property string $pin
 * @property string $telephone
 * @property string $email
 * @property string $hospital_logo
 * @property string $hospital_photo
 * @property string $website
 * @property string $created_by
 * @property string $updated_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Hospital extends Model
{
	protected $table = 'hospital';

	protected $casts = [
		'hospital_id' => 'int',
		'city' => 'int',
		'country' => 'int'
	];

	protected $fillable = [
		'hospital_id',
		'hospital_name',
		'address',
		'city',
		'country',
		'hid',
		'pin',
		'telephone',
		'email',
		'hospital_logo',
		'hospital_photo',
		'website',
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
		return $this->belongsTo(\App\Models\User::class, 'hospital_id');
	}
}
