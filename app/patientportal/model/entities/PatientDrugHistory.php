<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PatientDrugHistory
 * 
 * @property int $id
 * @property string $drug_name
 * @property int $patient_id
 * @property string $dosage
 * @property string $timings
 * @property \Carbon\Carbon $drug_history_date
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class PatientDrugHistory extends Eloquent
{
	protected $table = 'patient_drug_history';

	protected $casts = [
		'patient_id' => 'int'
	];

	protected $dates = [
		'drug_history_date'
	];

	protected $fillable = [
		'drug_name',
		'patient_id',
		'dosage',
		'timings',
		'drug_history_date',
		'created_by',
		'modified_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'patient_id');
	}
}
