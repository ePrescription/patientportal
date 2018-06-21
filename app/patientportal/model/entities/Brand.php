<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Brand
 * 
 * @property int $id
 * @property string $brand_name
 * @property string $trade_id
 * @property int $drug_id
 * @property string $dosage
 * @property string $dosage_amount
 * @property string $dispensing_form
 * @property int $brand_status
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Drug $drug
 * @property \Illuminate\Database\Eloquent\Collection $prescription_details
 *
 * @package App\Models
 */
class Brand extends Eloquent
{
	protected $casts = [
		'drug_id' => 'int',
		'brand_status' => 'int'
	];

	protected $fillable = [
		'brand_name',
		'trade_id',
		'drug_id',
		'dosage',
		'dosage_amount',
		'dispensing_form',
		'brand_status',
		'created_by',
		'modified_by'
	];

	public function drug()
	{
		return $this->belongsTo(\App\Models\Drug::class);
	}

	public function prescription_details()
	{
		return $this->hasMany(\App\Models\PrescriptionDetail::class);
	}
}
