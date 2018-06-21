<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TempDetail
 * 
 * @property string $t_schema
 * @property string $t_table
 * @property string $t_field
 *
 * @package App\Models
 */
class TempDetail extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		't_schema',
		't_table',
		't_field'
	];
}
