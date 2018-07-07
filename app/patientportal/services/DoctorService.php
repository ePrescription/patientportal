<?php

namespace App\patientportal\services;

use App\Http\ViewModels\NewAppointmentViewModel;
use App\patientportal\repositories\repoInterface\DoctorInterface;
use Illuminate\Support\Facades\DB;


/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/30/18
 * Time: 12:33 PM
 */
class DoctorService
{
    protected $doctorRepo;

    public function __construct(DoctorInterface $doctorRepo)
    {
        //   dd('Inside constructor');
        $this->doctorRepo = $doctorRepo;
    }


    public function BookDoctorAppointment($patientProfileVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($patientProfileVM, &$status)
            {
                $status = $this->doctorRepo->BookDoctorAppointment($patientProfileVM);
            });

        }
        catch(HospitalException $hospitalExc)
        {
            $status = false;
            throw $hospitalExc;
        }
        catch(UserNotFoundException $userExc)
        {
            $status = false;
            throw $userExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_PROFILE_SAVE_ERROR, $ex);
        }

        return $status;
    }

    public function getHospitalsList($speciality,$doctorId)
    {
         $hospitals=null;
        try {

            $hospitals = $this->doctorRepo->getHospitalsList($speciality,$doctorId);


        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
            //$msg->sendUnExpectedExpectionResponse($exc);
        }
        return $hospitals;
    }
    public function getAddress($speciality,$doctorId,$hospitalId){

        $doctors=null;
        try {

            $doctors = $this->doctorRepo->getAddress($speciality,$doctorId,$hospitalId);


        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
            //$msg->sendUnExpectedExpectionResponse($exc);
        }
        return $doctors;
    }

    public function getDoctorsList($request)
    {
        $doctors=null;
        try {

            $doctors = $this->doctorRepo->getDoctorsList($request);


        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
            //$msg->sendUnExpectedExpectionResponse($exc);
        }
        return $doctors;
    }
    public function getAppointment($request){

        $appointment=null;
        try{

            $appointment=$this->doctorRepo->getAppointment($request);

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $appointment;
    }
    public function getDoctorAppointment(){

        $doctorappointment=null;
        try{

            $doctorappointment=$this->doctorRepo->getDoctorAppointment();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $doctorappointment;
    }
    public function getPharmacyAppointments(){

        $pharmacyappointment=null;
        try{

            $pharmacyappointment=$this->doctorRepo->getPharmacyAppointments();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $pharmacyappointment;
    }
    public function getAskQuestions(){

        $askquestions=null;
        try{

            $askquestions=$this->doctorRepo->getAskQuestions();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $askquestions;
    }
    public function getLabDates(){

        $examinationDates=null;
        try{

            $examinationDates=$this->doctorRepo->getLabDates();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $examinationDates;
    }

    public function getAppointments(){

        $labappointments=null;
        try{

            $labappointments=$this->doctorRepo->getAppointments();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $labappointments;
    }

    public function AskQuestionPage(){

        $askquestions=null;
        try{

            $askquestions=$this->doctorRepo->AskQuestionPage();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $askquestions;
    }

    public function saveQuestion($request){
        $status=null;
        try{
            $status=$this->doctorRepo->saveQuestion($request);

        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $status;
    }
    public function saveSecondOpinion($request){
        $status=null;
        try{
            $status=$this->doctorRepo->saveSecondOpinion($request);

        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $status;
    }


    public function getSingleDoctor($request)
    {
        $Alldata = null;
        try {

            $Alldata = $this->doctorRepo->getSingleDoctor($request);

        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $Alldata;
    }

    public function getDoctors()
    {
        $doctors = null;
        try {
            $doctors=$this->doctorRepo->getDoctors();

        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {//dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);//error_log($status);
        }
        return $doctors;
    }

    public function getTokenIdByHospitalIdandDoctorId($hospitalId,$doctorId,$date,$type)
    {
        $TokenId = null;

        try
        {
            $TokenId = $this->doctorRepo->getTokenIdByHospitalIdandDoctorId($hospitalId,$doctorId,$date,$type);
        }
        catch(HospitalException $hospitalExc)
        {
            throw $hospitalExc;
        }
        catch(Exception $exc)
        {
            throw new HospitalException(null, ErrorEnum::HOSPITAL_DOCTOR_LIST_ERROR, $exc);
        }
        return $TokenId;
    }

    public function getHospitalDoctors($hospitalId)
    {
        $doctors = null;
        try {
            $doctors = $this->doctorRepo->getHospitalDoctors($hospitalId);


        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $doctors;
    }
}