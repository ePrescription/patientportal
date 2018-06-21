<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class City
 * 
 * @property int $id
 * @property string $city_name
 * @property int $country
 * @property int $city_status
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $doctors
 * @property \Illuminate\Database\Eloquent\Collection $hospitals
 * @property \Illuminate\Database\Eloquent\Collection $labs
 * @property \Illuminate\Database\Eloquent\Collection $patients
 * @property \Illuminate\Database\Eloquent\Collection $pharmacies
 *
 * @package App\Models
 */
class City extends Eloquent
{
	protected $casts = [
		'country' => 'int',
		'city_status' => 'int'
	];

	protected $fillable = [
		'city_name',
		'country',
		'city_status',
		'created_by',
		'modified_by'
	];

	public function country()
	{
		return $this->belongsTo(\App\Models\Country::class, 'country');
	}

	public function doctors()
	{
		return $this->hasMany(\App\Models\Doctor::class, 'city');
	}

	public function hospitals()
	{
		return $this->hasMany(\App\Models\Hospital::class, 'city');
	}

	public function labs()
	{
		return $this->hasMany(\App\Models\Lab::class, 'city');
	}

	public function patients()
	{
		return $this->hasMany(\App\Models\Patient::class, 'city');
	}

	public function pharmacies()
	{
		return $this->hasMany(\App\Models\Pharmacy::class, 'city');
	}
}
