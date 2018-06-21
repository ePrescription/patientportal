<?php

namespace App\patientportal\repositories\repoInterface;
use App\Http\ViewModels\PatientProfileViewModel;

/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/27/18
 * Time: 4:24 PM
 */
interface UserInterface
{
    public function registerPatientDetails($regrequest);
    public function saveNewPatientProfile(PatientProfileViewModel $patientProfileVM);


}