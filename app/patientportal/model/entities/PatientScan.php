<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace  App\patientportal\modal;

use  Eloquent;

/**
 * Class PatientScan
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $scan_id
 * @property int $is_value_set
 * @property \Carbon\Carbon $scan_date
 * @property int $is_fees_paid
 * @property string $created_by
 * @property \Carbon\Carbon $created_at
 * @property string $modified_by
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 * @property \App\Models\Scan $scan
 *
 * @package App\Models
 */
class PatientScan extends Eloquent
{
	protected $table = 'patient_scan';

	protected $casts = [
		'patient_id' => 'int',
		'scan_id' => 'int',
		'is_value_set' => 'int',
		'is_fees_paid' => 'int'
	];

	protected $dates = [
		'scan_date'
	];

	protected $fillable = [
		'patient_id',
		'scan_id',
		'is_value_set',
		'scan_date',
		'is_fees_paid',
		'created_by',
		'modified_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'patient_id');
	}

	public function scan()
	{
		return $this->belongsTo(\App\Models\Scan::class);
	}
}
