<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace  App\patientportal\modal;

use  Eloquent;

/**
 * Class Scan
 * 
 * @property int $id
 * @property string $scan_name
 * @property int $status
 * @property float $fee
 * @property string $created_by
 * @property \Carbon\Carbon $created_at
 * @property string $modified_by
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $patient_scans
 *
 * @package App\Models
 */
class Scan extends Eloquent
{
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'status' => 'int',
		'fee' => 'float'
	];

	protected $fillable = [
		'scan_name',
		'status',
		'fee',
		'created_by',
		'modified_by'
	];

	public function patient_scans()
	{
		return $this->hasMany(\App\Models\PatientScan::class);
	}
}
