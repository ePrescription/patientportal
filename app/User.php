<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable;
    //use Authorizable,
    use CanResetPassword;
    use EntrustUserTrait;
    //use HasRoles;

    protected $table = 'users';

    //use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function patient()
    {
        return $this->hasOne('App\patientportal\model\entities\Patient', 'patient_id');
    }
    public function appointments()
    {
        return $this->hasMany('App\patientportal\modal\DoctorAppointment', 'doctor_id');
    }
    public function patienthospitals()
    {
        return $this->belongsToMany('App\patientportal\model\Patient', 'hospital_patient', 'patient_id', 'hospital_id')
            ->withPivot('created_by', 'updated_by')
            ->withTimestamps();
    }
    public function hospital()
    {
        return $this->hasOne('App\patientportal\modal\Hospital', 'hospital_id');
    }

    public function prescriptions()
    {
        return $this->hasMany('App\patientportal\modal\PatientPrescription', 'patient_id');
    }

    public function labtests()
    {
        return $this->hasMany('App\patientportal\modal\PatientLabTests', 'patient_id');
    }

    public function pharmacy()
    {
        return $this->hasOne('App\patientportal\modal\Pharmacy', 'pharmacy_id');
    }

    public function lab()
    {
        return $this->hasOne('App\patientportal\modal\Lab', 'lab_id');
    }



    public function feereceipts()
    {
        return $this->hasMany('App\patientportal\modal\FeeReceipt', 'doctor_id');
    }

    public function doctor()
    {
        return $this->hasOne('App\patientportal\modal\Doctor', 'doctor_id');
    }

    public function personalhistory()
    {
        return $this->belongsToMany('App\patientportal\modal\PersonalHistory',
            'patient_personal_history', 'patient_id', 'personal_history_id')
            ->withPivot('personal_history_item_id', 'is_value_set', 'personal_history_date', 'doctor_id', 'hospital_id',
                'created_by', 'modified_by', 'created_at', 'updated_at');
    }

    public function patientgeneralexaminations()
    {
        return $this->belongsToMany('App\patientportal\modal\GeneralExamination',
            'patient_general_examination', 'patient_id', 'general_examination_id')
            ->withPivot('general_examination_value', 'is_value_set', 'general_examination_date', 'doctor_id', 'hospital_id',
                'created_by', 'modified_by', 'created_at', 'updated_at');
    }

    public function patientpastillness()
    {
        return $this->belongsToMany('App\patientportal\modal\PastIllness',
            'patient_past_illness', 'patient_id', 'past_illness_id')
            ->withPivot('past_illness_name', 'is_value_set', 'doctor_id', 'hospital_id',
                'created_by', 'modified_by', 'created_at', 'updated_at');
    }

    public function patientfamilyillness()
    {
        return $this->belongsToMany('App\patientportal\modal\FamilyIllness',
            'patient_family_illness', 'patient_id', 'family_illness_id')
            ->withPivot('family_illness_name', 'relation', 'is_value_set', 'family_illness_date', 'doctor_id', 'hospital_id',
                'created_by', 'modified_by', 'created_at', 'updated_at');
    }

    public function patientpregnancy()
    {
        return $this->belongsToMany('App\patientportal\modal\Pregnancy',
            'patient_pregnancy', 'patient_id', 'pregnancy_id')
            ->withPivot('pregnancy_value', 'pregnancy_date', 'is_value_set', 'doctor_id', 'hospital_id',
                'created_by', 'modified_by', 'created_at', 'updated_at');
    }

    public function patientscans()
    {
        return $this->belongsToMany('App\patientportal\modal\Scans',
            'patient_scan', 'patient_id', 'scan_id')
            ->withPivot('scan_date', 'is_value_set', 'doctor_id', 'hospital_id',
                'created_by', 'modified_by', 'created_at', 'updated_at');
    }

    public function patienturineexaminations()
    {
        return $this->belongsToMany('App\patientportal\modal\UrineExamination',
            'patient_urine_examination', 'patient_id', 'urine_examination_id')
            ->withPivot('examination_date', 'is_value_set', 'doctor_id', 'hospital_id',
                'created_by', 'modified_by', 'created_at', 'updated_at');
    }

    public function patientmotionexaminations()
    {
        return $this->belongsToMany('App\patientportal\modal\MotionExamination',
            'patient_motion_examination', 'patient_id', 'motion_examination_id')
            ->withPivot('examination_date', 'is_value_set', 'doctor_id', 'hospital_id',
                'created_by', 'modified_by', 'created_at', 'updated_at');
    }

    public function patientbloodexaminations()
    {
        return $this->belongsToMany('App\patientportal\modal\BloodExamination',
            'patient_blood_examination', 'patient_id', 'blood_examination_id')
            ->withPivot('examination_date', 'is_value_set', 'doctor_id', 'hospital_id',
                'created_by', 'modified_by', 'created_at', 'updated_at');
    }


    public function patientultrasounds()
    {
        return $this->belongsToMany('App\patientportal\modal\Ultrasound',
            'patient_ultra_sound', 'patient_id', 'ultra_sound_id')
            ->withPivot('examination_date', 'is_value_set', 'doctor_id', 'hospital_id',
                'created_by', 'modified_by', 'created_at', 'updated_at');
    }

    public function patientdrughistory()
    {
        return $this->hasMany('App\patientportal\modal\PatientDrugHistory', 'patient_id');
    }

    public function patientsurgeries()
    {
        return $this->hasMany('App\patientportal\modal\PatientSurgeries', 'patient_id');
    }

    public function patientdiagnosis()
    {
        return $this->hasMany('App\patientportal\modal\PatientDiagnosis', 'patient_id');
    }

    public  static function authenticateUser($user,$pass){

        $use=User::where([['email','=',$user],['password','=',$pass]])->get();
        return $use;
    }

}
