<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PersonalHistoryItem
 * 
 * @property int $id
 * @property string $personal_history_item_name
 * @property int $status
 * @property int $personal_history_id
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\PersonalHistory $personal_history
 * @property \Illuminate\Database\Eloquent\Collection $patient_personal_histories
 *
 * @package App\Models
 */
class PersonalHistoryItem extends Eloquent
{
	protected $table = 'personal_history_item';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'status' => 'int',
		'personal_history_id' => 'int'
	];

	protected $fillable = [
		'personal_history_item_name',
		'status',
		'personal_history_id',
		'created_by',
		'modified_by'
	];

	public function personal_history()
	{
		return $this->belongsTo(\App\Models\PersonalHistory::class);
	}

	public function patient_personal_histories()
	{
		return $this->hasMany(\App\Models\PatientPersonalHistory::class);
	}
}
