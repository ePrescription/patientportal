<?php

namespace App\Http\Controllers\Lab;
use App\Http\Controllers\Controller;

use App\Http\ViewModels\PatientUrineExaminationViewModel;
use App\patientportal\facades\Userfacade;
use App\patientportal\mapper\LabMapper;
use App\patientportal\mapper\PatientProfileMapper;
use App\patientportal\modal\BloodExamination;
use App\patientportal\modal\Hospital;
use App\patientportal\modal\MotionExamination;
use App\patientportal\modal\Scan;
use App\patientportal\modal\UltraSound;
use App\patientportal\modal\UrineExamination;
use App\patientportal\modal\HospitalLab;
use App\patientportal\modal\Lab;
use App\patientportal\modal\Labtest;
use App\patientportal\modal\Sms;
use App\patientportal\modal\Patient;
use App\User;
use App\patientportal\utilities\Exception\AppendMessage;
use App\patientportal\utilities\Exception\LabException;
use App\patientportal\utilities\Exception\HospitalException;
use Illuminate\Support\Facades\DB;


use App\patientportal\services\LabService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Mockery\Exception;

class LabController extends Controller {

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $labService;

    public function __construct(LabService $labService)
    {
        //   dd('Inside constructor');
        $this->labService = $labService;
    }

    public function BookLabAppointment(Request $request) {
        try{

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
            //$msg->sendUnExpectedExpectionResponse($exc);
        }



        $typeoftest = $request->get("typeoftest");
        $subtest = $request->get("subtest");
        $labs = $request->get("labs");
        $address = $request->get("address");
        $date = $request->get("date");
        //$timeslot = $request->get("timeslot");
        $briefnote = $request->get("briefnote");
        $labapp = new \App\Labappointment();
        $labapp->patient_id = session('patient_id');
        $labapp->lab_id = $labs;
        $labapp->labtest_id = $subtest;
        //get hospital id
        $hspid= HospitalLab::where('lab_id','=',$labs)->get();
        $labapp->hospital_id = $hspid[0]->hospital_id;
        $labapp->brief_history = $briefnote;
        $labapp->appointment_type = 1;
        $labapp->appointment_date = date('Y-m-d', strtotime($date));
        //$time_input = $timeslot;
        //$tim = date('Y-m-d H:i:s', strtotime($date . " " . $timeslot));
       // $labapp->appointment_time = $tim;
        $labapp->created_by = 'admin';
        $labapp->modified_by = 'admin';

        $labapp->save();
        $labinfo = Lab ::where('lab_id','=',$labs)->get();
        $testinfo =Labtest ::find($subtest);

         $id=$labapp->id;
   
        $labappointments= \App\Labappointment::join('lab','lab.lab_id','=','lab_appointment.lab_id')->join('hospital','hospital.hospital_id','=','lab_appointment.hospital_id')->where('lab_appointment.patient_id','=',session('patient_id'))->where('lab_appointment.id','=',$id)->select('lab_appointment.id','lab.address as labaddress','lab.name as lab','lab_appointment.appointment_date','lab_appointment.brief_history','hospital.hospital_name','hospital.email','hospital.address as hsaddress','hospital.telephone')->paginate(10);
  
         //$mails=[session('email'),$labinfo[0]->email];
         
         $mails = array();
            if (session('email') != "") {
                $mails[count($mails)] = session('email');
            }
            if ($labinfo[0]->email != "") {
                $mails[count($mails)] = $labinfo[0]->email;
            }

            if (count($mails) > 0) {
        Mail::send('maillayout.doctor_appointment', ['doctorappointments' => $labappointments], function($msg) use($mails) {
            $msg->subject('Book Lab Appointment');
            $msg->from(session('email'));
            $msg->to($mails);
        });
            }
            
            
             $mblno='';
            if(session('patient_id')!=""){
               $patient= Patient::where('patient_id', '=', session('patient_id'))->get();
               if($patient[0]['telephone']!=""){
                   $mblno=$patient[0]['telephone'];
               }
            }
            if ($labinfo[0]->telephone != "") {
                $mblno =$mblno.",".$labinfo[0]->telephone;
            }
            if($mblno!=""){
                $msg="Patient ID:".session('patient_id');
                $msg=$msg."%0APatient Name:".session('userID');
                $msg=$msg."%0ADoctor Name:".$labappointments[0]->name;
                $msg=$msg."%0ABrief Note:".$labappointments[0]->brief_history;
                $msg=$msg."%0ADOA:".$labappointments[0]->appointment_date;
                Sms::sendMSG($mblno, $msg);
            }
            
       // return view('labmailtemplate',['date' => $date, 'briefnote' => $briefnote, 'labinfo' => $labinfo,'testinfo'=> $testinfo]);
        return redirect()->back()->with('msg', 'Successfully Confirmed your appointment.!');


       /*   Mail::send('labmailtemplate', ['date' => $date, 'briefnote' => $briefnote, 'labinfo' => $labinfo,'testinfo'=> $testinfo], function($msg) use( $labinfo) {
            $msg->subject('Book Lab Appointment');
            $msg->from(session('email'));
            $msg->to($labinfo[0]->email);
        });
       // return view('labmailtemplate',['date' => $date, 'briefnote' => $briefnote, 'labinfo' => $labinfo,'testinfo'=> $testinfo]);
        return redirect()->back()->with('msg', 'Successfully Confirmed your appointment.!');
*/
        
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function getAppointment(Request $request){

        $appointment=null;
        try{

            $appointment=$this->labService->getAppointment($request);

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

    public function loadLabs(Request $request){

        $labs=null;
        try{

            $labs=$this->labService->loadLabs($request);

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
    public function loadSubTests(Request $request){

        $subtests=null;
        try{

            $subtests=$this->labService->loadSubTests($request);

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
    public function getBloodTestsEntries(Request $request){

        $bloodTests=null;
        $hospitals=null;
        try{

            $PatientBloodTests=$this->labService->getBloodTestsEntries();

            $bloodTests=$PatientBloodTests['bloodtests'];
            $hospitals=$PatientBloodTests['hospitals'];

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
       // dd($bloodTests);
        return view('bloodtest')->with('bloodTests', $bloodTests)->with('hospitals',$hospitals);
    }



    public function getMotionTestsEntries(Request $request){
        $hospitals=null;
        $patientMotionTests=null;
        try{

            $patientMotionTests1=$this->labService->getMotionTestsEntries();

            //$patientMotionTests =MotionExamination::all();
            $patientMotionTests=$patientMotionTests1['motiontests'];
            $hospitals=$patientMotionTests1['hospitals'];



        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return view('motiontest')->with('patientMotionTests', $patientMotionTests)->with('hospitals',$hospitals);
    }

    public function getScanTestsEntries(Request $request){
        $hospitals=null;
        $patientScans=null;
        try{

            $PatientScanTests=$this->labService->getScanTestsEntries();

            $patientScans =$PatientScanTests['scantests'];
            $hospitals=$PatientScanTests['hospitals'];


        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
            dd($patientScans);
        }
        return view('scantest')->with('patientScans',$patientScans)->with('hospitals',$hospitals);

    }

    public function getUrineTestsEntries(Request $request){

        $hospitals=null;
        $patientUrineTests=null;
        try{
            $patientUrineTests1=$this->labService->getUrineTestsEntries();
            $patientUrineTests =$patientUrineTests1['urinetests'];
            $hospitals=$patientUrineTests1['hospitals'];



        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        //dd($patientUrineTests1);
        return view('urinetest')->with('patientUrineTests', $patientUrineTests)->with('hospitals',$hospitals);
    }


    public function getDentalTestsEntries(Request $request){
        $hospitals=null;
            $dentalExaminations = null;
            $dentalExaminationCategory = null;

            try{
     // $dentalExaminations = HospitalServiceFacade::getAllDentalItems();

                $PatientDentalTests=$this->labService->getDentalTestsEntries();

                $dentalExaminations=$PatientDentalTests['dentaltests'];
                $dentalExaminationCategory=$PatientDentalTests['$dentalExaminationCategory'];
                $hospitals=$PatientDentalTests['hospitals'];




            } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return view('dentaltest')->with('dentalExaminations', $dentalExaminations)->with('dentalExaminationCategory', $dentalExaminationCategory)->with('hospitals',$hospitals);
    }
    public function getXrayTestsEntries(Request $request){
        $hospitals=null;
        $xrayExaminations = null;
        $xrayExaminationCategory = null;

   try{
       $PatientXrayTests=$this->labService->getXrayTestsEntries();


       $xrayExaminations=$PatientXrayTests['bloodtests'];
       $xrayExaminationCategory=$PatientXrayTests['xrayExaminationCategory'];
       $hospitals=$PatientXrayTests['hospitals'];


   } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        //dd($xrayExaminations);

        return view('xraytest')->with('xrayExaminations', $xrayExaminations)->with('xrayExaminationCategory', $xrayExaminationCategory)->with('hospitals',$hospitals);
    }
    public function getUltrasoundTestsEntries(Request $request){
        $hospitals=null;
        $patientUltraSoundTests=null;
        try{

            $patientUltraSoundTests1=$this->labService->getUltrasoundTestsEntries();

            $patientUltraSoundTests=$patientUltraSoundTests1['ultrasound'];
            $hospitals=$patientUltraSoundTests1['hospitals'] ;


        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        //dd($patientUltraSoundTests);
        return view('ultrasoundtest')->with('patientUltraSoundTests', $patientUltraSoundTests)->with('hospitals',$hospitals);
    }

    /**
     * Save patient patient blood examination details
     * @param $examinationRequest
     * @throws $hospitalException
     * @return true | false
     * @author Ramana
     */





    public function savePatientBloodTests(Request $examinationRequest)
    {
        $patientBloodVM = null;
        $status = true;
        $responseJson = null;
        try
        {
            //dd($examinationRequest);
            //dd($personalHistoryRequest->all());
            $patientBloodVM = PatientProfileMapper::setPatientBloodExamination($examinationRequest);
          //dd($patientBloodVM);
            //$patientBloodVM = LabMapper::setLabTestMapper($testRequest);
            //dd($patientBloodVM->getPatientId());
            $status =$this->labService->savePatientBloodTestsNew1($patientBloodVM);
            //dd($status);
            //lab/4/hospital/1/patient/317/lab-details
            if($status)
            {
                return redirect()->back()->with('msg','Appointment Booked Successfully');
            }
            else
            {
                return redirect()->back()->with('msg','FAILURE');
            }
        }
        catch(LabException $labExc)
        {
            $errorMsg = $labExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($labExc);
            Log::error($msg);
        }
        catch(Exception $exc)
        {
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }
    }

    /**
     * Save motion test results
     * @param $examinationRequest
     * @throws $labException
     * @return true | false
     * @author Ramana
     */
    public function savePatientMotionTests(Request $examinationRequest)
    {
        $patientBloodVM = null;
        $status = true;
        $responseJson = null;
        try
        {
            $patientMotionVM = PatientProfileMapper::setPatientMotionExamination($examinationRequest);
            //dd($patientMotionVM);
            $status = $this->labService->savePatientMotionTests($patientMotionVM);

            if($status)
            {
                return  redirect()->back()->with('msg','Appointment Booked Successfully');
            }
            else
            {
                return redirect()->back()->with('msg','FAILURE');
            }
        }
        catch(LabException $labExc)
        {
            $errorMsg = $labExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($labExc);
            Log::error($msg);
        }
        catch(Exception $exc)
        {
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }
        return redirect()->back()->with('msg','');

    }
    /**
     * Save UltraSound test results
     * @param $examinationRequest
     * @throws $labException
     * @return true | false
     * @author Ramana
     */
    public function savePatientUltraSoundTests(Request $examinationRequest)
    {
        $patientUltraSoundVM = null;
        $status = true;
        $responseJson = null;
        try
        {
            $patientUltraSoundVM = PatientProfileMapper::setPatientUltraSoundExamination($examinationRequest);
            $status = $this->labService->savePatientUltraSoundTests($patientUltraSoundVM);
            if($status)
            {
                return redirect('labappointment?methode=Lab')->with('msg','Appointment Booked Successfully');
            }
            else
            {
                return redirect('labappointment?methode=Lab')->with('msg','FAILURE');
            }
        }
        catch(LabException $labExc)
        {
            $errorMsg = $labExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($labExc);
            Log::error($msg);
        }
        catch(Exception $exc)
        {
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }
        return redirect('labappointment?methode=Lab')->with('msg','');
    }

    /**
     * Save patient urine examination details
     * @param $examinationRequest
     * @throws $hospitalException
     * @return true | false
     * @author Ramana
     */

    public function savePatientUrineTests(Request $examinationRequest)
    {
        $patientUrineVM = null;
        $status = true;
        $responseJson = null;

        try
        {
            $patientUrineVM = PatientProfileMapper::setPatientUrineExamination($examinationRequest);
            $status = $this->labService->savePatientUrineTests($patientUrineVM);

            if($status)
            {
                return redirect('labappointment?methode=Lab')->with('msg','Appointment Booked Successfully');
            }
            else
            {
                return redirect('labappointment?methode=Lab')->with('msg','FAILURE');
            }
        }
        catch(LabException $labExc)
        {
            $errorMsg = $labExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($labExc);
            Log::error($msg);
        }
        catch(Exception $exc)
        {
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }
        return redirect('labappointment?methode=Lab')->with('msg','');

    }
    /**
     * Save patient Xray examination details
     * @param $examinationRequest
     * @throws $hospitalException
     * @return true | false
     * @author Ramana
     */


    public function savePatientXRayTests(Request $xrayRequest)
    {
        $patientXRayVM = null;
        $status = true;
        $responseJson = null;

        try
        {
            //dd($xrayRequest);
            //dd($personalHistoryRequest->all());
            $patientXRayVM = PatientProfileMapper::setPatientXRayExamination($xrayRequest);
            //dd($patientMotionVM);
            $status = $this->labService->savePatientXRayTests($patientXRayVM);

            if($status)
            {
                return redirect('labappointment?methode=Lab')->with('msg','Appointment Booked Successfully');
            }
            else
            {
                return redirect('labappointment?methode=Lab')->with('msg','FAILURE');
            }
        }
        catch(LabException $labExc)
        {
            $errorMsg = $labExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($labExc);
            Log::error($msg);
        }
        catch(Exception $exc)
        {
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }
        return redirect('labappointment?methode=Lab')->with('msg','');

    }

    /**
     * Save patient dental tests
     * @param $dentalRequest
     * @throws $hospitalException
     * @return true | false
     * @author Ramana
     */

    public function savePatientDentalTests(Request $dentalRequest)
    {
        $patientDentalVM = null;
        $status = true;
        $responseJson = null;

        try
        {
            //dd($dentalRequest->all());
            $patientDentalVM = PatientProfileMapper::setPatientDentalExamination($dentalRequest);
            $status = $this->labService->savePatientDentalTests($patientDentalVM);

            if($status)
            {
                return redirect('labappointment?methode=Lab')->with('msg','Appointment Booked Successfully');
            }
            else
            {
                return redirect('labappointment?methode=Lab')->with('msg','FAILURE');
            }
        }
        catch(LabException $labExc)
        {
            $errorMsg = $labExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($labExc);
            Log::error($msg);
        }
        catch(Exception $exc)
        {
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }
        return redirect('labappointment?methode=Lab')->with('msg','');

    }

    /**
     * Save patient scan details
     * @param $scanRequest
     * @throws $hospitalException
     * @return true | false
     * @author Ramana
     */

    public function savePatientScanDetails(Request $scanRequest)
    {
        $patientScanVM = null;
        $status = true;
        $responseJson = null;

        try
        {
            $patientScanVM = PatientProfileMapper::setPatientScanDetails($scanRequest);
            $status = $this->labService->savePatientScanDetails($patientScanVM);
            if($status)
            {
                return redirect('labappointment?methode=Lab')->with('msg','Appointment Booked Successfully');
            }
            else
            {
                return redirect('labappointment?methode=Lab')->with('msg','FAILURE');
            }
        }
        catch(LabException $labExc)
        {
            $errorMsg = $labExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($labExc);
            Log::error($msg);
        }
        catch(Exception $exc)
        {
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }
        return redirect('labappointment?methode=Lab')->with('msg','');
    }

    public function loaddoctorLab(Request $request){
        $doctors=null;

        try{

            $doctors=$this->labService->loaddoctorLab($request);



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

    public function PatientLabDetailsResultsByHospitalForFront($hid, $patientId)
    {
        $patientDetails = null;
        $patientPrescriptions = null;
        $labTests = null;
        $patientAppointment = null;
        //$jsonResponse = null;
        //dd('Inside patient details');
        try {
            $patientDetails = $this->labService->getPatientProfile($patientId);
            $patientExaminations = $this->labService->getExaminationDates($patientId, $hid);
           // dd($patientExaminations);
        } catch (HospitalException $hospitalExc) {
            //dd($hospitalExc);
            //$jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::PATIENT_DETAILS_ERROR));
            $errorMsg = $hospitalExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($hospitalExc);
            Log::error($msg);
        } catch (Exception $exc) {
            //dd($exc);
            //$jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::PATIENT_DETAILS_ERROR));
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return view('patient-labReport', compact('patientExaminations', 'patientDetails'));

    }




    /**
     * To Display patient Lab Test Based on Date
     * @param $hid, $patientId, $date
     * @throws $HospitalException
     * @return Array|null
     * @author Ramana
     */

//RAMANA
    public function PatientLabReportsByHospitalForDoctor($patientId, $hid, $date)
    {
        $patientDetails = null;
        $patientPrescriptions = null;
        $labTests = null;
        $patientAppointment = null;
        //$jsonResponse = null;
        try {
            $patientDetails =$this->labService->getPatientProfile($patientId);
            // $patientExaminations = HospitalServiceFacade::getExaminationDates($patientId, $hid);
            $patientExaminations = $this->labService->getExaminationDatesByDate($patientId, $hid, $date);
            //dd($patientExaminations);
        } catch (HospitalException $hospitalExc) {
            //$jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::PATIENT_DETAILS_ERROR));
            $errorMsg = $hospitalExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($hospitalExc);
            Log::error($msg);
        } catch (Exception $exc) {
            //dd($exc);
            //$jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::PATIENT_DETAILS_ERROR));
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return view('maillayout.doctor_appointment', compact('patientExaminations', 'patientDetails'));

    }

    public function PatientLabDetails($hid, $patientId)
    {
        $patientDetails = null;
        $patientPrescriptions = null;
        $labTests = null;
        $patientAppointment = null;
        //$jsonResponse = null;
        //dd('Inside patient details');
        try {
            $patientDetails = HospitalServiceFacade::getPatientProfile($patientId);
            $patientExaminations = HospitalServiceFacade::getExaminationDates($patientId, $hid);
            //dd($patientExaminations);
        } catch (HospitalException $hospitalExc) {
            //dd($hospitalExc);
            //$jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::PATIENT_DETAILS_ERROR));
            $errorMsg = $hospitalExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($hospitalExc);
            Log::error($msg);
        } catch (Exception $exc) {
            //dd($exc);
            //$jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::PATIENT_DETAILS_ERROR));
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return view('portal.hospital-patient-labReport', compact('patientExaminations', 'patientDetails'));

    }



}
