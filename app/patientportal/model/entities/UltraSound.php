<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;

use  Eloquent;

/**
 * Class UltraSound
 * 
 * @property int $id
 * @property string $examination_name
 * @property int $status
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $patient_ultra_sounds
 *
 * @package App\Models
 */
class UltraSound extends Eloquent
{
	protected $table = 'ultra_sound';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'examination_name',
		'status',
		'created_by',
		'modified_by'
	];

	public function patient_ultra_sounds()
	{
		return $this->hasMany(\App\Models\PatientUltraSound::class);
	}
}
