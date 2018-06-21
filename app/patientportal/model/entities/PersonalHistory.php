<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PersonalHistory
 * 
 * @property int $id
 * @property string $personal_history_name
 * @property int $status
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $patient_personal_histories
 * @property \Illuminate\Database\Eloquent\Collection $personal_history_items
 *
 * @package App\Models
 */
class PersonalHistory extends Eloquent
{
	protected $table = 'personal_history';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'personal_history_name',
		'status',
		'created_by',
		'modified_by'
	];

	public function patient_personal_histories()
	{
		return $this->hasMany(\App\Models\PatientPersonalHistory::class);
	}

	public function personal_history_items()
	{
		return $this->hasMany(\App\Models\PersonalHistoryItem::class);
	}
}
