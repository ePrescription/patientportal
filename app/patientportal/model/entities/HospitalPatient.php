<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Oct 2017 07:09:24 +0000.
 */

namespace App\patientportal\modal;

use Eloquent;

/**
 * Class HospitalPatient
 * 
 * @property int $id
 * @property int $hospital_id
 * @property int $patient_id
 * @property string $created_by
 * @property string $updated_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class HospitalPatient extends Eloquent
{
	protected $table = 'hospital_patient';

}
