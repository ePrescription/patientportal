<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GeneralExamination
 * 
 * @property int $id
 * @property string $general_examination_name
 * @property int $status
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $patient_general_examinations
 *
 * @package App\Models
 */
class GeneralExamination extends Eloquent
{
	protected $table = 'general_examination';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'general_examination_name',
		'status',
		'created_by',
		'modified_by'
	];

	public function patient_general_examinations()
	{
		return $this->hasMany(\App\Models\PatientGeneralExamination::class);
	}
}
