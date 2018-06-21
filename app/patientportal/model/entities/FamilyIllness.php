<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FamilyIllness
 * 
 * @property int $id
 * @property string $illness_name
 * @property int $status
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $patient_family_illnesses
 *
 * @package App\Models
 */
class FamilyIllness extends Eloquent
{
	protected $table = 'family_illness';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'illness_name',
		'status',
		'created_by',
		'modified_by'
	];

	public function patient_family_illnesses()
	{
		return $this->hasMany(\App\Models\PatientFamilyIllness::class);
	}
}
