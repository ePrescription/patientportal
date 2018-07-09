<?php
namespace App\patientportal\model;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 7/9/18
 * Time: 10:45 AM
 */

class PharmacyAppointmentDocuments extends Model
{

    protected $table="pharmacy_pickup_documents";

    public function PharmacyDocuments(){

        return $this->belongsTo('App\patientportal\modal\pharmacy_pickup', 'pharmacy_pickup_documents_ 	pharmacy_pickup_id');


    }
}