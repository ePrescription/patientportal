<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $phonecode
 * @property int $country_status
 * @property string $created_by
 * @property string $updated_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $cities
 * @property \Illuminate\Database\Eloquent\Collection $doctors
 * @property \Illuminate\Database\Eloquent\Collection $hospitals
 * @property \Illuminate\Database\Eloquent\Collection $labs
 * @property \Illuminate\Database\Eloquent\Collection $patients
 * @property \Illuminate\Database\Eloquent\Collection $pharmacies
 *
 * @package App\Models
 */
class Country extends Eloquent
{
	protected $casts = [
		'phonecode' => 'int',
		'country_status' => 'int'
	];

	protected $fillable = [
		'code',
		'name',
		'phonecode',
		'country_status',
		'created_by',
		'updated_by'
	];

	public function cities()
	{
		return $this->hasMany(\App\Models\City::class, 'country');
	}

	public function doctors()
	{
		return $this->hasMany(\App\Models\Doctor::class, 'country');
	}

	public function hospitals()
	{
		return $this->hasMany(\App\Models\Hospital::class, 'country');
	}

	public function labs()
	{
		return $this->hasMany(\App\Models\Lab::class, 'country');
	}

	public function patients()
	{
		return $this->hasMany(\App\Models\Patient::class, 'country');
	}

	public function pharmacies()
	{
		return $this->hasMany(\App\Models\Pharmacy::class, 'country');
	}
}
