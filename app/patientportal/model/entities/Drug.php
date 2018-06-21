<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Drug
 * 
 * @property int $id
 * @property string $drug_name
 * @property string $manufacturer
 * @property string $anatomical_group
 * @property string $therapeutic_sub_group
 * @property string $pharmacological_group
 * @property string $chemical_group
 * @property string $atc_code
 * @property int $drug_status
 * @property string $created_by
 * @property string $modified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $brands
 * @property \Illuminate\Database\Eloquent\Collection $prescription_details
 *
 * @package App\Models
 */
class Drug extends Eloquent
{
	protected $casts = [
		'drug_status' => 'int'
	];

	protected $fillable = [
		'drug_name',
		'manufacturer',
		'anatomical_group',
		'therapeutic_sub_group',
		'pharmacological_group',
		'chemical_group',
		'atc_code',
		'drug_status',
		'created_by',
		'modified_by'
	];

	public function brands()
	{
		return $this->hasMany(\App\Models\Brand::class);
	}

	public function prescription_details()
	{
		return $this->hasMany(\App\Models\PrescriptionDetail::class);
	}
}
