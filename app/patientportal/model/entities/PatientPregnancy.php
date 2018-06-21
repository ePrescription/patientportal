<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PatientPregnancy
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $pregnancy_id
 * @property string $pregnancy_value
 * @property int $is_value_set
 * @property \Carbon\Carbon $pregnancy_date
 * @property string $created_by
 * @property \Carbon\Carbon $created_at
 * @property string $modified_by
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 * @property \App\Models\Pregnancy $pregnancy
 *
 * @package App\Models
 */
class PatientPregnancy extends Eloquent
{
	protected $table = 'patient_pregnancy';

	protected $casts = [
		'patient_id' => 'int',
		'pregnancy_id' => 'int',
		'is_value_set' => 'int'
	];

	protected $dates = [
		'pregnancy_date'
	];

	protected $fillable = [
		'patient_id',
		'pregnancy_id',
		'pregnancy_value',
		'is_value_set',
		'pregnancy_date',
		'created_by',
		'modified_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'patient_id');
	}

	public function pregnancy()
	{
		return $this->belongsTo(\App\Models\Pregnancy::class);
	}
}
