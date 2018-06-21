<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PatientFamilyIllness
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $family_illness_id
 * @property string $family_illness_name
 * @property string $relation
 * @property int $is_value_set
 * @property \Carbon\Carbon $family_illness_date
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\FamilyIllness $family_illness
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class PatientFamilyIllness extends Eloquent
{
	protected $table = 'patient_family_illness';

	protected $casts = [
		'patient_id' => 'int',
		'family_illness_id' => 'int',
		'is_value_set' => 'int'
	];

	protected $dates = [
		'family_illness_date'
	];

	protected $fillable = [
		'patient_id',
		'family_illness_id',
		'family_illness_name',
		'relation',
		'is_value_set',
		'family_illness_date',
		'created_by',
		'modified_by'
	];

	public function family_illness()
	{
		return $this->belongsTo(\App\Models\FamilyIllness::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'patient_id');
	}
}
