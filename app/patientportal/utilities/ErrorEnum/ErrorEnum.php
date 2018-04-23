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




}
