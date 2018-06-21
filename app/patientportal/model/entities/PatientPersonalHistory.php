<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PatientPersonalHistory
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $personal_history_id
 * @property int $personal_history_item_id
 * @property int $is_value_set
 * @property \Carbon\Carbon $personal_history_date
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 * @property \App\Models\PersonalHistory $personal_history
 * @property \App\Models\PersonalHistoryItem $personal_history_item
 *
 * @package App\Models
 */
class PatientPersonalHistory extends Eloquent
{
	protected $table = 'patient_personal_history';

	protected $casts = [
		'patient_id' => 'int',
		'personal_history_id' => 'int',
		'personal_history_item_id' => 'int',
		'is_value_set' => 'int'
	];

	protected $dates = [
		'personal_history_date'
	];

	protected $fillable = [
		'patient_id',
		'personal_history_id',
		'personal_history_item_id',
		'is_value_set',
		'personal_history_date',
		'created_by',
		'modified_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'patient_id');
	}

	public function personal_history()
	{
		return $this->belongsTo(\App\Models\PersonalHistory::class);
	}

	public function personal_history_item()
	{
		return $this->belongsTo(\App\Models\PersonalHistoryItem::class);
	}
}
