<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FeeReceipt
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $hospital_id
 * @property int $doctor_id
 * @property float $fee
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class FeeReceipt extends Eloquent
{
	protected $table = 'fee_receipt';

	protected $casts = [
		'patient_id' => 'int',
		'hospital_id' => 'int',
		'doctor_id' => 'int',
		'fee' => 'float'
	];

	protected $fillable = [
		'patient_id',
		'hospital_id',
		'doctor_id',
		'fee',
		'created_by',
		'modified_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'patient_id');
	}
}
