<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PrescriptionDetail
 * 
 * @property int $id
 * @property int $patient_prescription_id
 * @property int $drug_id
 * @property string $brief_description
 * @property string $dosage
 * @property int $no_of_days
 * @property string $intake_form
 * @property int $morning
 * @property int $afternoon
 * @property int $night
 * @property string $drug_status
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $brand_id
 * 
 * @property \App\Models\Brand $brand
 * @property \App\Models\Drug $drug
 * @property \App\Models\PatientPrescription $patient_prescription
 *
 * @package App\Models
 */
class PrescriptionDetail extends Eloquent
{
	protected $casts = [
		'patient_prescription_id' => 'int',
		'drug_id' => 'int',
		'no_of_days' => 'int',
		'morning' => 'int',
		'afternoon' => 'int',
		'night' => 'int',
		'brand_id' => 'int'
	];

	protected $fillable = [
		'patient_prescription_id',
		'drug_id',
		'brief_description',
		'dosage',
		'no_of_days',
		'intake_form',
		'morning',
		'afternoon',
		'night',
		'drug_status',
		'created_by',
		'modified_by',
		'brand_id'
	];

	public function brand()
	{
		return $this->belongsTo(\App\Models\Brand::class);
	}

	public function drug()
	{
		return $this->belongsTo(\App\Models\Drug::class);
	}

	public function patient_prescription()
	{
		return $this->belongsTo(\App\Models\PatientPrescription::class);
	}
}
