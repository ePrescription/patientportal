<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace  App\patientportal\modal;

use  Eloquent;

/**
 * Class LabtestDetail
 * 
 * @property int $id
 * @property int $patient_labtest_id
 * @property int $labtest_id
 * @property string $brief_description
 * @property string $labtest_report
 * @property string $labtest_report_status
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Labtest $labtest
 * @property \App\Models\PatientLabtest $patient_labtest
 *
 * @package App\Models
 */
class LabtestDetail extends Eloquent
{
	protected $casts = [
		'patient_labtest_id' => 'int',
		'labtest_id' => 'int'
	];

	protected $fillable = [
		'patient_labtest_id',
		'labtest_id',
		'brief_description',
		'labtest_report',
		'labtest_report_status',
		'created_by',
		'modified_by'
	];

	public function labtest()
	{
		return $this->belongsTo(\App\Models\Labtest::class);
	}

	public function patient_labtest()
	{
		return $this->belongsTo(\App\Models\PatientLabtest::class);
	}
}
