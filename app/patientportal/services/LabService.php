<?php

namespace App\patientportal\services;

use App\patientportal\repositories\repoInterface\LabInterface;
use App\patientportal\utilities\ErrorEnum\ErrorEnum;
use App\patientportal\utilities\Exception\HospitalException;
use Illuminate\Support\Facades\DB;


/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/30/18
 * Time: 12:33 PM
 */
class LabService
{
    protected $labRepo;

    public function __construct(LabInterface $labRepo)
    {
        //   dd('Inside constructor');
        $this->labRepo = $labRepo;
    }

    public function BookLabAppointment($request)
    {


        $status = null;
        try {

            $status = $this->labRepo->BookLabAppointment($request);


        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
            //$msg->sendUnExpectedExpectionResponse($exc);
        }
        return $status;

    }
    public function getAppointment($request){

        $appointment=null;
        try{

            $appointment=$this->labRepo->getAppointment($request);

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

    public function loadLabs($request){

        $labs=null;
        try{

            $labs=$this->labRepo->loadLabs($request);

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $labs;
    }
    public function loadSubTests($request){

        $subtests=null;
        try{

            $subtests=$this->labRepo->loadSubTests($request);

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $subtests;
    }

/*LAB ENTRY FORMS*/

    public function getBloodTestsEntries(){

        $bloodTests=null;
        try{

            $bloodTests=$this->labRepo->getBloodTestsEntries();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $bloodTests;
    }

    public function getMotionTestsEntries(){

        $bloodTests=null;
        try{

            $bloodTests=$this->labRepo->getMotionTestsEntries();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $bloodTests;
    }

    public function getUrineTestsEntries(){

        $bloodTests=null;
        try{

            $bloodTests=$this->labRepo->getUrineTestsEntries();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $bloodTests;
    }
    public function getScanTestsEntries(){

        $bloodTests=null;
        try{

            $bloodTests=$this->labRepo->getScanTestsEntries();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $bloodTests;
    }

    public function getDentalTestsEntries(){

        $bloodTests=null;
        try{

            $bloodTests=$this->labRepo->getDentalTestsEntries();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $bloodTests;
    }

    public function getUltrasoundTestsEntries(){

        $bloodTests=null;
        try{

            $bloodTests=$this->labRepo->getUltrasoundTestsEntries();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $bloodTests;
    }

    public function getXrayTestsEntries(){

        $bloodTests=null;
        try{

            $bloodTests=$this->labRepo->getXrayTestsEntries();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $bloodTests;
    }


    public function savePatientBloodTestsNew1($patientBloodVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($patientBloodVM, &$status)
            {
                //$status = $this->hospitalRepo->savePatientBloodTests($patientBloodVM);
                $status = $this->labRepo->savePatientBloodTestsNew1($patientBloodVM);
            });

        }
        catch(HospitalException $hospitalExc)
        {
            $status = false;
            throw $hospitalExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_BLOOD_DETAILS_SAVE_ERROR, $ex);
        }

        return $status;
    }


    /**
     * Save motion test results
     * @param $testResultsVM
     * @throws $labException
     * @return true | false
     * @author Baskar
     */
    public function savePatientUrineTests($patientUrineVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($patientUrineVM, &$status)
            {
                //$status = $this->hospitalRepo->savePatientUrineTests($patientUrineVM);
                $status = $this->labRepo->savePatientUrineTestsNew($patientUrineVM);
            });

        }
        catch(HospitalException $hospitalExc)
        {
            $status = false;
            throw $hospitalExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_URINE_DETAILS_SAVE_ERROR, $ex);
        }

        return $status;
    }

    /**
     * Save patient motion examination details
     * @param $patientMotionVM
     * @throws $hospitalException
     * @return true | false
     * @author Baskar
     */

    public function savePatientMotionTests($patientMotionVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($patientMotionVM, &$status)
            {
                //$status = $this->hospitalRepo->savePatientMotionTests($patientMotionVM);
                $status = $this->labRepo->savePatientMotionTestsNew($patientMotionVM);
            });

        }
        catch(HospitalException $hospitalExc)
        {
            $status = false;
            throw $hospitalExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_MOTION_DETAILS_SAVE_ERROR, $ex);
        }

        return $status;
    }

    public function savePatientUltraSoundTests($patientUltraSoundVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($patientUltraSoundVM, & $status)
            {
                //$status = $this->hospitalRepo->savePatientUltraSoundTests($patientUltraSoundVM);
                $status = $this->labRepo->savePatientUltraSoundTestsNew($patientUltraSoundVM);
            });

        }
        catch(HospitalException $hospitalExc)
        {
            $status = false;
            throw $hospitalExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_ULTRASOUND_DETAILS_SAVE_ERROR, $ex);
        }

        return $status;
    }

    /**
     * Save patient dental tests
     * @param $patientDentalVM
     * @throws $hospitalException
     * @return true | false
     * @author Baskar
     */

    public function savePatientDentalTests($patientDentalVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($patientDentalVM, &$status)
            {
                $status = $this->labRepo->savePatientDentalTests($patientDentalVM);
            });

        }
        catch(HospitalException $hospitalExc)
        {
            $status = false;
            throw $hospitalExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_DENTAL_TESTS_SAVE_ERROR, $ex);
        }

        return $status;
    }

    /**
     * Save patient XRAY tests
     * @param $patientXRayVM
     * @throws $hospitalException
     * @return true | false
     * @author Baskar
     */

    public function savePatientXRayTests($patientXRayVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($patientXRayVM, &$status)
            {
                $status = $this->labRepo->savePatientXRayTests($patientXRayVM);
            });

        }
        catch(HospitalException $hospitalExc)
        {
            $status = false;
            throw $hospitalExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_XRAY_TESTS_SAVE_ERROR, $ex);
        }

        return $status;
    }


    public function savePatientScanDetails($patientScanVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($patientScanVM, &$status)
            {
                //$status = $this->hospitalRepo->savePatientScanDetails($patientScanVM);
                $status = $this->labRepo->savePatientScanDetailsNew($patientScanVM);
            });

        }
        catch(HospitalException $hospitalExc)
        {
            $status = false;
            throw $hospitalExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_SCAN_SAVE_ERROR, $ex);
        }

        return $status;
    }

    public function loaddoctorLab($request){
        $doctors=null;

        try{

            $doctors=$this->labRepo->loaddoctorLab($request);

        }catch (Exception $Labexc){
            $msg = AppendMessage::appendMessage($Labexc);
            Log::error($msg);

        }
        catch(Exception $exc)
        {
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $doctors;
    }

    public function getPatientProfile($patientId)
    {
        $patientProfile = null;

        try
        {
            $patientProfile = $this->labRepo->getPatientProfile($patientId);
        }
        catch(HospitalException $hospitalExc)
        {
            throw $hospitalExc;
        }
        catch(Exception $exc)
        {
            throw new HospitalException(null, ErrorEnum::PATIENT_PROFILE_ERROR, $exc);
        }

        return $patientProfile;
    }
    public function getExaminationDatesByDate($patientId, $hospitalId,$date)
    {
        $examinationDates = null;

        try
        {
            $examinationDates = $this->labRepo->getExaminationDatesByDate($patientId, $hospitalId,$date);
        }
        catch(HospitalException $hospitalExc)
        {
            throw $hospitalExc;
        }
        catch(Exception $exc)
        {
            throw new HospitalException(null, ErrorEnum::PATIENT_EXAMINATION_DATES_ERROR, $exc);
        }

        return $examinationDates;
    }
    public function getExaminationDates($patientId,$hospitalId)
    {
        $examinationDates = null;

        try
        {
            $examinationDates = $this->labRepo->getExaminationDatesByDate($patientId, $hospitalId);
        }
        catch(HospitalException $hospitalExc)
        {
            throw $hospitalExc;
        }
        catch(Exception $exc)
        {
            throw new HospitalException(null, ErrorEnum::PATIENT_EXAMINATION_DATES_ERROR, $exc);
        }

        return $examinationDates;
    }

}
