<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24/10/2017
 * Time: 4:47 PM
 */

namespace App\patientportal\utilities;


class AppointmentType
{
    const APPOINTMENT_OPEN = 1;
    const APPOINTMENT_VISITED = 2;
    const APPOINTMENT_TRANSFERRED = 3;
    const APPOINTMENT_CANCELLED = 4;
    const APPOINTMENT_POSTPONED = 5;
}