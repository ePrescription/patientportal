<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;

use Eloquent;

/**
 * Class Labtest
 * 
 * @property int $id
 * @property string $test_name
 * @property string $test_category
 * @property int $test_status
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $labs
 * @property \Illuminate\Database\Eloquent\Collection $labtest_details
 *
 * @package App\Models
 */
class Labtest extends Eloquent
{
	protected $table = 'labtest';

	protected $casts = [
		'test_status' => 'int'
	];

	protected $fillable = [
		'test_name',
		'test_category',
		'test_status',
		'created_by',
		'modified_by'
	];

	public function labs()
	{
		return $this->belongsToMany(\App\Models\Lab::class)
					->withPivot('id', 'created_by', 'updated_by')
					->withTimestamps();
	}

	public function labtest_details()
	{
		return $this->hasMany(\App\Models\LabtestDetail::class);
	}
}
