<?php
namespace App\patientportal\repositories\repoInterface;
use App\Http\ViewModels\NewAppointmentViewModel;
use App\Http\ViewModels\PatientProfileViewModel;

/**
* Created by PhpStorm.
* User: glodeveloper
* Date: 1/27/18
* Time: 4:24 PM
*/
interface DoctorInterface
{
public function BookDoctorAppointment(PatientProfileViewModel $patientProfileVM);
public function getHospitalsList($speciality,$doctorId);
public function getAddress($speciality,$doctorId,$hospitalId);
public function getDoctorsList($speciality);
public function getDoctorAvailability($request);
public function getAppointment($request);
public function getAppointments();
public function getPharmacyAppointments();
public function getAskQuestions();
public function getLabDates();
public function getDoctorAppointment();
public function AskQuestionPage();
public function saveQuestion($request);
public function saveSecondOpinion($request);
public function getSingleDoctor($request);
public function getDoctors();
public function getTokenIdByHospitalIdandDoctorId($hospitalId,$doctorId,$date,$type);
public function getHospitalDoctors($hospitalId);
    public function getHealthCheckupList();
    public function getLabTestListforHealthCheckup();
    public function saveHealthCheckup($request);

    public function getPatientHealthCheckups();
    public function getPatientSecondOpinion();


}