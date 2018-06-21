<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;

use Eloquent;

/**
 * Class LabLabtest
 * 
 * @property int $id
 * @property int $lab_id
 * @property int $labtest_id
 * @property string $created_by
 * @property string $updated_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Lab $lab
 * @property \App\Models\Labtest $labtest
 *
 * @package App\Models
 */
class LabLabtest extends Eloquent
{
	protected $table = 'lab_labtest';

	protected $casts = [
		'lab_id' => 'int',
		'labtest_id' => 'int'
	];

	protected $fillable = [
		'lab_id',
		'labtest_id',
		'created_by',
		'updated_by'
	];

	public function lab()
	{
		return $this->belongsTo(\App\Models\Lab::class);
	}

	public function labtest()
	{
		return $this->belongsTo(\App\Models\Labtest::class);
	}
}
