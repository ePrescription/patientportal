<?php
/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 7/6/18
 * Time: 3:17 PM
 */

namespace App\patientportal\model;


use Illuminate\Database\Eloquent\Model;

class SecondOpinion extends Model
{
    protected $table = 'patient_second_opinion';

    protected $casts = [
        'doctor_id' => 'int',
        'hospital_id' => 'int',
        'patient_id' => 'int'
    ];

    protected $fillable = [
        'doctor_id',
        'hospital_id',
        'patient_id',
        'speciality_id',
        'so_priority_id',
        'subject',
        'detailed_description',
        'created_by',
        'modified_by'
    ];



}