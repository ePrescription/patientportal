<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;

use  Eloquent;

/**
 * Class HospitalPharmacy
 * 
 * @property int $id
 * @property int $hospital_id
 * @property int $pharmacy_id
 * @property string $created_by
 * @property string $updated_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class HospitalPharmacy extends Eloquent
{
	protected $table = 'hospital_pharmacy';

	protected $casts = [
		'hospital_id' => 'int',
		'pharmacy_id' => 'int'
	];

	protected $fillable = [
		'hospital_id',
		'pharmacy_id',
		'created_by',
		'updated_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'pharmacy_id');
	}
}
