<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;

use Eloquent;

/**
 * Class UrineExamination
 * 
 * @property int $id
 * @property string $examination_name
 * @property int $status
 * @property float $fee
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $patient_urine_examinations
 *
 * @package App\Models
 */
class UrineExamination extends Eloquent
{
	protected $table = 'urine_examination';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'status' => 'int',
		'fee' => 'float'
	];

	protected $fillable = [
		'examination_name',
		'status',
		'fee',
		'created_by',
		'modified_by'
	];

	public function patient_urine_examinations()
	{
		return $this->hasMany(\App\Models\PatientUrineExamination::class);
	}
}
