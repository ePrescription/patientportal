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

    const PATIENT_DENTAL_TESTS_SAVE_ERROR = 131;
    const PATIENT_SCAN_SAVE_ERROR = 132;
    const PATIENT_BLOOD_DETAILS_SAVE_ERROR = 133;
    const PATIENT_XRAY_TESTS_SAVE_ERROR = 134;
    const PATIENT_ULTRASOUND_DETAILS_SAVE_ERROR = 135;
    const PATIENT_URINE_DETAILS_SAVE_ERROR = 136;
    const PATIENT_MOTION_DETAILS_SAVE_ERROR = 137;
    const PATIENT_MOTION_DETAILS_ERROR = 138;

    const PATIENT_EXAMINATION_DATES_ERROR = 139;
    const BLOODTEST_LIST_ERROR = 140;
    const URINETEST_LIST_ERROR = 141;
    const SCAN_LIST_ERROR = 142;
    const DENTAL_LIST_ERROR = 143;
    const XRAY_LIST_ERROR = 144;
    const PATIENT_TEST_RESULTS_ERROR = 145;

    const HEALTH_CHECKUPS_LIST_ERROR = 146;
    const HEALTH_CHECKUPS_SAVE_ERROR = 147;





















}
