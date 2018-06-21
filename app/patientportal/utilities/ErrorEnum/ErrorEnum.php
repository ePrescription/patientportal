<?php
namespace App\patientportal\utilities\ErrorEnum;

use MyCLabs\Enum\Enum;

class ErrorEnum extends Enum{

    const SUCCESS = 1;
    const FAILURE = 0;
    const USER_NOT_EXIST = 2;
    const VALIDATION_ERRORS = 3;
    const USER_NOT_FOUND = 4;
    const HOSPITAL_USER_NOT_FOUND = 5;
    const PATIENT_USER_NOT_FOUND = 6;
    const UNKNOWN_ERROR = 100;
    //Patient List
    const PATIENT_LIST_ERROR = 110;
    const PATIENT_LIST_SUCCESS = 111;
    const PATIENT_DETAILS_ERROR = 112;
    const PATIENT_DETAILS_SUCCESS = 113;
    const PATIENT_PROFILE_ERROR = 114;
    const PATIENT_PROFILE_SUCCESS = 115;
    const PATIENT_PROFILE_SAVE_ERROR = 116;
    const PATIENT_PROFILE_SAVE_SUCCESS = 117;
    const PATIENT_NEW_APPOINTMENT_ERROR = 118;
    const PATIENT_NEW_APPOINTMENT_SUCCESS = 119;
    const NEW_PATIENT_ERROR = 120;





}
