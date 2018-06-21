<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace  App\patientportal\modal;

use  Eloquent;

/**
 * Class Pregnancy
 * 
 * @property int $id
 * @property string $pregnancy_details
 * @property int $status
 * @property string $created_by
 * @property \Carbon\Carbon $created_at
 * @property string $modified_by
 * @property \Carbon\Carbon $modified_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $patient_pregnancies
 *
 * @package App\Models
 */
class Pregnancy extends Eloquent
{
	protected $table = 'pregnancy';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'modified_at'
	];

	protected $fillable = [
		'pregnancy_details',
		'status',
		'created_by',
		'modified_by',
		'modified_at'
	];

	public function patient_pregnancies()
	{
		return $this->hasMany(\App\Models\PatientPregnancy::class);
	}
}
