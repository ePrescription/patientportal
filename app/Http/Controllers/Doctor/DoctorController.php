<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientProfileWebRequest;
use App\Http\ViewModels\NewAppointmentViewModel;
use App\patientportal\common\ResponsePrescription;
use App\patientportal\mapper\PatientProfileMapper;
use App\patientportal\modal\Askquestion;
use App\patientportal\modal\Doctor;
use App\patientportal\modal\DoctorAppointment;
use App\patientportal\modal\Hospital;
use App\patientportal\modal\HospitalDoctor;
use App\patientportal\modal\DoctorAvailability;
use App\patientportal\modal\Patient;
use App\patientportal\modal\Sms;
use App\patientportal\utilities\ErrorEnum\ErrorEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;
use App\patientportal\services\DoctorService;
use App\patientportal\utilities\Exception\HospitalException;

class DoctorController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        //   dd('Inside constructor');
        $this->doctorService = $doctorService;
    }

    /*To Book Patient Appointment From PSSP*/
    public function BookDoctorAppointment(Request $patientProfileRequest)
    {
        $patientProfileVM = null;
        $status = true;
        //$jsonResponse = null;
        $msg = null;
        //return $patientProfileRequest->all();
     // dd($patientProfileRequest);

        try
        {

           /*//dd($patientProfileRequest['patient_photo']);
           $patient_photo = Input::file('patient_photo');
            if($patientProfileRequest['patient_photo']!=null)
            {
              //  dd('hi-if Con');
                $destinationPath = 'public/storage'; // upload path
              // dd($patient_photo);
                $extension = Input::file('patient_photo')->getClientOriginalExtension(); // getting file extension
               // dd($extension);
                //$fileName = rand(11111, 99999) . '.' . $extension; // renameing image
                $fileName = $patientProfileRequest->name.'_'.time() . '.' . $extension; // renameing image
                $upload_success = Input::file('patient_photo')->move($destinationPath, $fileName); // uploading file to given path
                $fileLocation = $destinationPath.'/'.$fileName;

                //$patientProfileRequest->patientPhoto = $fileName;
                //$patientProfileRequest['patientPhoto'] = $fileName;
                $patientProfileRequest['patient_photo'] = $fileLocation;
                // dd($patientProfileRequest['patient_photo']);
            }
            else
            {
              //  dd('hi-ELSE Con');
                //$patientProfileRequest->patientPhoto = "";
                $patientProfileRequest['patient_photo'] = "";
            }*/
           // dd($patientProfileVM);
            $patientProfileVM = PatientProfileMapper::setPatientProfilePSSP($patientProfileRequest);
            //dd($patientProfileVM);
            $status =$this->doctorService->BookDoctorAppointment($patientProfileVM);
          //  dd($status);
            if($status)
            {
                //$jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::PATIENT_PROFILE_SAVE_SUCCESS));
                // rest/api/{labId}/hospital/{hospitalId}/addpatientwithappointment
                $msg = " Patient Appointment Booked Successfully.";
               return redirect()->back()->with('msg',$msg);
            }
            else
            {
                $msg = "Patient Details Invalid / Incorrect! Try Again.";
               // return redirect('lab/rest/api/'.Session::get('LoginUserHospital').'/addpatientwithappointment')->with('message',$msg);
                return redirect()->back()->with('msg',$msg);

            }

        }
        catch(HospitalException $hospitalExc)
        {
            //$jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::PATIENT_PROFILE_SAVE_ERROR));
            $errorMsg = $hospitalExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($hospitalExc);
            Log::error($msg);
            //return $jsonResponse;
        }
        catch(Exception $exc)
        {
            //dd($exc);
            //$jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::PRESCRIPTION_DETAILS_SAVE_ERROR));
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        //return redirect('fronthospital/rest/api/'.Auth::user()->id.'/addpatientwithappointment')->with('message',$msg);

        //$msg = "Patient Details Invalid / Incorrect! Try Again.";
        //return redirect('fronthospital/rest/api/'.Auth::user()->id.'/addpatientwithappointment')->with('message',$msg);
        //return $jsonResponse;

    }
    /*TO GET ALL Doctors Information*/
    public function getDoctors(Request $request){

        $doctors=null;

        try{
            $doctors=$this->doctorService->getDoctorsList($request);

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


    /*Load Hospitals By DoctorId*/

    public function getHospitals(Request $request){

     $hospitals=null;

        try{
            $speciality = $request->input("specialty");
            $doctorId = $request->input("doctor_id");

            $hospitals=$this->doctorService->getHospitalsList($speciality,$doctorId);

          } catch (Exception $userExc) {

        $errorMsg = $userExc->getMessageForCode();

        $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
      //dd($exc);
      $msg = AppendMessage::appendGeneralException($exc);
       //error_log($status);
        }
     return $hospitals;
        }
    public function getAddress(Request $request){

        $hospitals=null;

        try{
            $specialty = $request->input("specialty");
            $doctor_id = $request->input("doctor_id");
            $hsp_id = $request->input("hsp_id");

            $hospitals=$this->doctorService->getAddress($specialty,$doctor_id,$hsp_id);

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $hospitals;

    }


    public function getDoctorAvailability(Request $request){

        $timeslots=null;

        try{

            $timeslots=$this->doctorService->getDoctorAvailability($request);

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $timeslots;

    }

    /*To Get Appointment View Page*/

      public function getAppointment(Request $request){
          $appointment=null;
          try{
              $totalInfo=$this->doctorService->getAppointment($request);
              $specialty=$totalInfo['specialty'];
              $typeoftest=$totalInfo['typeoftest'];
              $hospitals= $totalInfo['hospitals'];
          } catch (Exception $userExc) {
              $errorMsg = $userExc->getMessageForCode();
              $msg = AppendMessage::appendMessage($userExc);
          } catch (Exception $exc) {
              //dd($exc);
              $msg = AppendMessage::appendGeneralException($exc);
              //error_log($status);
          }
          //return $appointment;
          return view('appointment')->with('specialty', $specialty)->with('typeoftest', $typeoftest)->with('hospitals', $hospitals);

      }


    public function getAppointments(){
        $appointments=null;
        try{
            $appointments=$this->doctorService->getAppointments();

        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $appointments;
    }
    public function getPharmacyAppointments(){
        $pharmacyappointments=null;
        try{
            $pharmacyappointments=$this->doctorService->getPharmacyAppointments();

        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $pharmacyappointments;
    }
   /**/
    public function getAskQuestions(){
        $askquestions=null;
        try{
            $askquestions=$this->doctorService->getAskQuestions();

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

    /*TO Get All History Of User
    1.All Questions
    2.All Doctor Appointments
    3.All Pharmacy Appointments
    4.All Lab Appointments

    */


    public function getHistory(){
        $askquestions=null;
        $labappointments=null;
        $pharmacyappointments=null;
        $healthcheckups=null;
        $examinationDates=null;
        $doctorappointments=null;
        try{
            $hospitals = Hospital::all();

            //$labappointments=$this->doctorService->getAppointments();
            $askquestions=$this->doctorService->getAskQuestions();
            $pharmacyappointments=$this->doctorService->getPharmacyAppointments();
            $healthcheckups = $this->doctorService->getPatientHealthCheckups();
            $examinationDates=$this->doctorService->getLabDates();
            $doctorappointments=$this->doctorService->getDoctorAppointment();
    } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        //dd($pharmacyappointments);
        return view('history')->with('hospitals', $hospitals)->with('doctorappointments', $doctorappointments)->with('labappointments', $labappointments)->with('pharmacyappointments', $pharmacyappointments)->with('healthcheckups', $healthcheckups)->with('askquestions', $askquestions)->with('examinationDates',$examinationDates);
    }




    public function AskQuestionPage(){
        $specialty=null;
        try{
            $hospitals = Hospital::all();
            $specialty=$this->doctorService->AskQuestionPage();

        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        //dd($specialty);
       return view('askquestion')->with('specialty', $specialty)->with('hospitals', $hospitals);
    }




    public function saveQuestion(Request $request){
        $status=null;
        try{
            $hospitals = Hospital::all();
            $status=$this->doctorService->saveQuestion($request);

        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return redirect()->back()->with('msg', 'Your Query is submited Successfully !');
    }




    public function SingleDoctor(Request $request){
        $Alldata=null;
        try{

            $Alldata=$this->doctorService->getSingleDoctor($request);
            $totaldoctorinfo= $Alldata['doctorinfo'];
            $hospital=$Alldata['hospital'];
            $hospitals=$Alldata['allhospital'];
            $doctors=$Alldata['doctors'];

        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return view('singledoctor')->with('hospitals', $hospitals)->with('doctorinfo', $totaldoctorinfo)->with('hospital', $hospital)->with('doctors', $doctors);
    }




    public function SecondOptionPage(){
        $specialty=null;
        try{
            $hospitals = Hospital::all();
            $specialty=$this->doctorService->AskQuestionPage();

        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return view('secondoption')->with('specialty', $specialty)->with('hospitals', $hospitals);
    }

    public function saveSecondOpinion(Request $request){
        $status=null;
        try{
            $hospitals = Hospital::all();
            $status=$this->doctorService->saveSecondOpinion($request);
        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }

        return redirect()->back()->with('msg', 'Your Query is submitted Successfully !');
    }



    public function DoctorsPage(){
        $specialty=null;
        try{
            $hospitals = Hospital::all();
            $specialty=$this->doctorService->AskQuestionPage();
            $doctors=$this->doctorService->getDoctors();


        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
       // dd($specialty);
        return view('doctors')->with('specialty', $specialty)->with('doctors', $doctors)->with('hospitals', $hospitals);
    }
    public function DoctorsList(Request $request){
        $doctors=null;
        try{
            $doctors=$this->doctorService->getDoctorsList($request);
            //$doctors=$this->doctorService->getDoctors();
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
    public function AskMsgLayout(Request $request){
        $doctors=null;
        try{
            $did = $request->input("did");
            $date = $request->input("date");
            $askquestions =DB::table('patient_ask_question as askquestion')
                ->join('doctor', 'doctor.doctor_id', '=', 'askquestion.doctor_id')
                ->join('patient_ask_question_documents', 'patient_ask_question_documents.patient_ask_question_id', '=', 'askquestion.id')
                ->join('hospital', 'hospital.hospital_id', '=', 'askquestion.hospital_id')
                ->where('askquestion.patient_id', '=', session('patient_id'))
                ->where('askquestion.doctor_id', '=', $did)
                ->where('askquestion.created_at', '=', $date)
                ->select('doctor.name', 'doctor.specialty', 'askquestion.created_at as appointment_date','askquestion.subject','askquestion.detailed_description as brief_history', 'hospital.hospital_name', 'hospital.email', 'hospital.address as hsaddress', 'hospital.telephone', 'patient_ask_question_documents.document_path as reports')->paginate(10);

            //$doctorappointments=\App\DoctorAppointment::join('doctor','doctor.doctor_id','=','doctor_appointment.doctor_id')->join('hospital','hospital.hospital_id','=','doctor_appointment.hospital_id')->where('doctor_appointment.patient_id','=',session('patient_id'))->where('doctor_appointment.id','=',$id)->select('doctor.name','doctor.specialty','doctor_appointment.appointment_date','doctor_appointment.brief_history','hospital.hospital_name','hospital.email','hospital.address as hsaddress','hospital.telephone')->get();

        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return view("maillayout.ask_appointment")->with('doctorappointments', $askquestions);
    }

    public function DoctorAppointmentLabel(Request $request){
        $doctors=null;
        try{
            $id = $request->input("id");

            $doctorappointments =DoctorAppointment::join('doctor', 'doctor.doctor_id', '=', 'doctor_appointment.doctor_id')
                ->join('hospital', 'hospital.hospital_id', '=', 'doctor_appointment.hospital_id')
                ->where('doctor_appointment.patient_id', '=', session('patient_id'))
                ->where('doctor_appointment.id', '=', $id)
                ->select('doctor.name', 'doctor.specialty', 'doctor_appointment.appointment_date','doctor_appointment.appointment_time as time', 'doctor_appointment.brief_history', 'hospital.hospital_name', 'hospital.email', 'hospital.address as hsaddress', 'hospital.telephone')->get();

        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return view("maillayout.doctor_appointmentnew")->with('doctorappointments', $doctorappointments);
    }

    public function getTokenIdByHospitalIdandDoctorId($hospitalId,$doctorId,$date,Request $appointmentrequest){

        $TokenID = null;
        //$jsonResponse = null;
        $responseJson = null;
        $count = 0;

        $type = $appointmentrequest->get("appointmentCategory");

        try
        {
            $TokenID = $this->doctorService->getTokenIdByHospitalIdandDoctorId($hospitalId,$doctorId,$date,$type);

        }
        catch(HospitalException $hospitalExc)
        {
           $responseJson = new ResponsePrescription(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::HOSPITAL_DOCTOR_LIST_ERROR));
            $responseJson->sendErrorResponse($hospitalExc);
        }
        catch(Exception $exc)
        {
            $responseJson = new ResponsePrescription(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::HOSPITAL_DOCTOR_LIST_ERROR));
            $responseJson->sendUnExpectedExpectionResponse($exc);
        }
        dd($TokenID);
        //return $jsonResponse;
        return $TokenID;
    }
    public function getHospitalDoctors($hospitalId)
    {
        $doctors = null;
        try {
            $doctors = $this->doctorService->getHospitalDoctors($hospitalId);


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

    public function getAppointmentTimes(Request $request)
    {
        $time_array = null;
        $responseJson = null;

        $dateValue=$request->date;
        $timeValue=$request->time;
        $AppointmentType="1";

        $currentDateValue=date("Y-m-d");
        $currentTimeValue=date("h:i:s");
        $hospitalId=$request->hospitalId;
        $doctorId=$request->doctorId;
        $day=date("D",strtotime($dateValue));

        // dd($day."".$dateValue.'--'.$hospitalId.'---'.$doctorId);
        $time_array = array();
        try
        {
            $checkArray=DB::table('doctor_leaves_schedule as dls')
                ->where('dls.doctor_id',$doctorId)->where('hospital_id',$hospitalId)
                ->where('leave_start_date','<=',$dateValue)
                ->where('leave_end_date','>=',$dateValue)->get();
            //dd(count($checkArray));
            if(count($checkArray)==0) {

                $TimeSchedule = DoctorAvailability::where('doctor_id', '=', $doctorId)
                    ->where('hospital_id', '=', $hospitalId)
                    ->where('week_day', '=', strtoupper($day))->get();
                //dd($TimeSchedule);
                // dd($TimeSchedule);

                if (count($TimeSchedule) > 0) {

                    if ($AppointmentType == 1 || $AppointmentType == 2) {

                        $mftime = strtotime($dateValue . " " . $TimeSchedule[0]->morning_start_time);
                        $mttime = strtotime($dateValue . " " . $TimeSchedule[0]->morning_end_time);
                        $mdiff = ($mttime - $mftime) / 300; //300 sec means 5 for each patiant tim


                        for ($i = 0; $i <= $mdiff; $i++) {

                            $time_array[date('H:i:s', $mftime + (300 * $i))] = date('h:i a', $mftime + (300 * $i));

                        }
                        //dd($time_array);

                        $eftime = strtotime($dateValue . " " . $TimeSchedule[0]->afternoon_start_time);
                        $ettime = strtotime($dateValue . " " . $TimeSchedule[0]->afternoon_end_time);
                        $ediff = ($ettime - $eftime) / 300; //300 sec means 5 for each patiant tim

                        for ($i = 0; $i < $ediff; $i++) {

                            $time_array[date('H:i:s', $eftime + (300 * $i))] = date('h:i a', $eftime + (300 * $i));


                        }

                        $Evftime = strtotime($dateValue . " " . $TimeSchedule[0]->evening_start_time);
                        $Evttime = strtotime($dateValue . " " . $TimeSchedule[0]->evening_end_time);
                        $eVdiff = ($Evttime - $Evftime) / 300; //300 sec means 5 for each patiant tim

                        for ($i = 0; $i < $eVdiff; $i++) {

                            $time_array[date('H:i:s', $Evftime + (300 * $i))] = date('h:i a', $Evftime + (300 * $i));


                        }
                    }else{

                        $mftime = strtotime($dateValue . " " . $TimeSchedule[0]->morning_start_time);
                        $mttime = strtotime($dateValue . " " . $TimeSchedule[0]->morning_end_time);
                        $mdiff = ($mttime - $mftime) / 900; //300 sec means 5 for each patiant tim


                        for ($i = 0; $i <= $mdiff; $i++) {

                            $time_array[date('H:i:s', $mftime + (900 * $i))] = date('h:i a', $mftime + (900 * $i));
                        }


                        $eftime = strtotime($dateValue . " " . $TimeSchedule[0]->afternoon_start_time);
                        $ettime = strtotime($dateValue . " " . $TimeSchedule[0]->afternoon_end_time);
                        $ediff = ($ettime - $eftime) / 900; //300 sec means 5 for each patiant tim

                        for ($i = 0; $i < $ediff; $i++) {

                            $time_array[date('H:i:s', $eftime + (900 * $i))] = date('h:i a', $eftime + (900 * $i));

                            //dd($time_array);
                        }

                        $Evftime = strtotime($dateValue . " " . $TimeSchedule[0]->evening_start_time);
                        $Evttime = strtotime($dateValue . " " . $TimeSchedule[0]->evening_end_time);
                        $eVdiff = ($Evttime - $Evftime) / 900; //300 sec means 5 for each patiant tim

                        for ($i = 0; $i < $eVdiff; $i++) {

                            $time_array[date('H:i:s', $Evftime + (900 * $i))] = date('h:i a', $Evftime + (900 * $i));

                            //dd($time_array);
                            // dd($time_array);
                        }

                    }

                } else {
                    //  dd('else');
                    $time_array = array(
                        '00:00:00' => '12:00 AM', '00:05:00' => '12:05 AM', '00:10:00' => '12:10 AM', '00:15:00' => '12:15 AM', '00:20:00' => '12:20 AM', '00:25:00' => '12:25 AM', '00:30:00' => '12:30 AM', '00:35:00' => '12:35 AM', '00:40:00' => '12:40 AM', '00:45:00' => '12:45 AM', '00:50:00' => '12:50 AM', '00:55:00' => '12:55 AM',
                        '01:00:00' => '01:00 AM', '01:05:00' => '01:05 AM', '01:10:00' => '01:10 AM', '01:15:00' => '01:15 AM', '01:20:00' => '01:20 AM', '01:25:00' => '01:25 AM', '01:30:00' => '01:30 AM', '01:35:00' => '01:35 AM', '01:40:00' => '01:40 AM', '01:45:00' => '01:45 AM', '01:50:00' => '01:50 AM', '01:55:00' => '01:55 AM',
                        '02:00:00' => '02:00 AM', '02:05:00' => '02:05 AM', '02:10:00' => '02:10 AM', '02:15:00' => '02:15 AM', '02:20:00' => '02:20 AM', '02:25:00' => '02:25 AM', '02:30:00' => '02:30 AM', '02:35:00' => '02:35 AM', '02:40:00' => '02:40 AM', '02:45:00' => '02:45 AM', '02:50:00' => '02:50 AM', '02:55:00' => '02:55 AM',
                        '03:00:00' => '03:00 AM', '03:05:00' => '03:05 AM', '03:10:00' => '03:10 AM', '03:15:00' => '03:15 AM', '03:20:00' => '03:20 AM', '03:25:00' => '03:25 AM', '03:30:00' => '03:30 AM', '03:35:00' => '03:35 AM', '03:40:00' => '03:40 AM', '03:45:00' => '03:45 AM', '03:50:00' => '03:50 AM', '03:55:00' => '03:55 AM',
                        '04:00:00' => '04:00 AM', '04:05:00' => '04:05 AM', '04:10:00' => '04:10 AM', '04:15:00' => '04:15 AM', '04:20:00' => '04:20 AM', '04:25:00' => '04:25 AM', '04:30:00' => '04:30 AM', '04:35:00' => '04:35 AM', '04:40:00' => '04:40 AM', '04:45:00' => '04:45 AM', '04:50:00' => '04:50 AM', '04:55:00' => '04:55 AM',
                        '05:00:00' => '05:00 AM', '05:05:00' => '05:05 AM', '05:10:00' => '05:10 AM', '05:15:00' => '05:15 AM', '05:20:00' => '05:20 AM', '05:25:00' => '05:25 AM', '05:30:00' => '05:30 AM', '05:35:00' => '05:35 AM', '05:40:00' => '05:40 AM', '05:45:00' => '05:45 AM', '05:50:00' => '05:50 AM', '05:55:00' => '05:55 AM',
                        '06:00:00' => '06:00 AM', '06:05:00' => '06:05 AM', '06:10:00' => '06:10 AM', '06:15:00' => '06:15 AM', '06:20:00' => '06:20 AM', '06:25:00' => '06:25 AM', '06:30:00' => '06:30 AM', '06:35:00' => '06:35 AM', '06:40:00' => '06:40 AM', '06:45:00' => '06:45 AM', '06:50:00' => '06:50 AM', '06:55:00' => '06:55 AM',
                        '07:00:00' => '07:00 AM', '07:05:00' => '07:05 AM', '07:10:00' => '07:10 AM', '07:15:00' => '07:15 AM', '07:20:00' => '07:20 AM', '07:25:00' => '07:25 AM', '07:30:00' => '07:30 AM', '07:35:00' => '07:35 AM', '07:40:00' => '07:40 AM', '07:45:00' => '07:45 AM', '07:50:00' => '07:50 AM', '07:55:00' => '07:55 AM',
                        '08:00:00' => '08:00 AM', '08:05:00' => '08:05 AM', '08:10:00' => '08:10 AM', '08:15:00' => '08:15 AM', '08:20:00' => '08:20 AM', '08:25:00' => '08:25 AM', '08:30:00' => '08:30 AM', '08:35:00' => '08:35 AM', '08:40:00' => '08:40 AM', '08:45:00' => '08:45 AM', '08:50:00' => '08:50 AM', '08:55:00' => '08:55 AM',
                        '09:00:00' => '09:00 AM', '09:05:00' => '09:05 AM', '09:10:00' => '09:10 AM', '09:15:00' => '09:15 AM', '09:20:00' => '09:20 AM', '09:25:00' => '09:25 AM', '09:30:00' => '09:30 AM', '09:35:00' => '09:35 AM', '09:40:00' => '09:40 AM', '09:45:00' => '09:45 AM', '09:50:00' => '09:50 AM', '09:55:00' => '09:55 AM',
                        '10:00:00' => '10:00 AM', '10:05:00' => '10:05 AM', '10:10:00' => '10:10 AM', '10:15:00' => '10:15 AM', '10:20:00' => '10:20 AM', '10:25:00' => '10:25 AM', '10:30:00' => '10:30 AM', '10:35:00' => '10:35 AM', '10:40:00' => '10:40 AM', '10:45:00' => '10:45 AM', '10:50:00' => '10:50 AM', '10:55:00' => '10:55 AM',
                        '11:00:00' => '11:00 AM', '11:05:00' => '11:05 AM', '11:10:00' => '11:10 AM', '11:15:00' => '11:15 AM', '11:20:00' => '11:20 AM', '11:25:00' => '11:25 AM', '11:30:00' => '11:30 AM', '11:35:00' => '11:35 AM', '11:40:00' => '11:40 AM', '11:45:00' => '11:45 AM', '11:50:00' => '11:50 AM', '11:55:00' => '11:55 AM',
                        '12:00:00' => '12:00 PM', '12:05:00' => '12:05 PM', '12:10:00' => '12:10 PM', '12:15:00' => '12:15 PM', '12:20:00' => '12:20 PM', '12:25:00' => '12:25 PM', '12:30:00' => '12:30 PM', '12:35:00' => '12:35 PM', '12:40:00' => '12:40 PM', '12:45:00' => '12:45 PM', '12:50:00' => '12:50 AM', '12:55:00' => '12:55 AM',
                        '13:00:00' => '01:00 PM', '13:05:00' => '01:05 PM', '13:10:00' => '01:10 PM', '13:15:00' => '01:15 PM', '13:20:00' => '01:20 PM', '13:25:00' => '01:25 PM', '13:30:00' => '01:30 PM', '13:35:00' => '01:35 PM', '13:40:00' => '01:40 PM', '13:45:00' => '01:45 PM', '13:50:00' => '01:50 PM', '13:55:00' => '01:55 PM',
                        '14:00:00' => '02:00 PM', '14:05:00' => '02:05 PM', '14:10:00' => '02:10 PM', '14:15:00' => '02:15 PM', '14:20:00' => '02:20 PM', '14:25:00' => '02:25 PM', '14:30:00' => '02:30 PM', '14:35:00' => '02:35 PM', '14:40:00' => '02:40 PM', '14:45:00' => '02:45 PM', '14:50:00' => '02:50 PM', '14:55:00' => '02:55 PM',
                        '15:00:00' => '03:00 PM', '15:05:00' => '03:05 PM', '15:10:00' => '03:10 PM', '15:15:00' => '03:15 PM', '15:20:00' => '03:20 PM', '15:25:00' => '03:25 PM', '15:30:00' => '03:30 PM', '15:35:00' => '03:35 PM', '15:40:00' => '03:40 PM', '15:45:00' => '03:45 PM', '15:50:00' => '03:50 PM', '15:55:00' => '03:55 PM',
                        '16:00:00' => '04:00 PM', '16:05:00' => '04:05 PM', '16:10:00' => '04:10 PM', '16:15:00' => '04:15 PM', '16:20:00' => '04:20 PM', '16:25:00' => '04:25 PM', '16:30:00' => '04:30 PM', '16:35:00' => '04:35 PM', '16:40:00' => '04:40 PM', '16:45:00' => '04:45 PM', '16:50:00' => '04:50 PM', '16:55:00' => '04:55 PM',
                        '17:00:00' => '05:00 PM', '17:05:00' => '05:05 PM', '17:10:00' => '05:10 PM', '17:15:00' => '05:15 PM', '17:20:00' => '05:20 PM', '17:25:00' => '05:25 PM', '17:30:00' => '05:30 PM', '17:35:00' => '05:35 PM', '17:40:00' => '05:40 PM', '17:45:00' => '05:45 PM', '17:50:00' => '05:50 PM', '17:55:00' => '05:55 PM',
                        '18:00:00' => '06:00 PM', '18:05:00' => '06:05 PM', '18:10:00' => '06:10 PM', '18:15:00' => '06:15 PM', '18:20:00' => '06:20 PM', '18:25:00' => '06:25 PM', '18:30:00' => '06:30 PM', '18:35:00' => '06:35 PM', '18:40:00' => '06:40 PM', '18:45:00' => '06:45 PM', '18:50:00' => '06:50 PM', '18:55:00' => '06:55 PM',
                        '19:00:00' => '07:00 PM', '19:05:00' => '07:05 PM', '19:10:00' => '07:10 PM', '19:15:00' => '07:15 PM', '19:20:00' => '07:20 PM', '19:25:00' => '07:25 PM', '19:30:00' => '07:30 PM', '19:35:00' => '07:35 PM', '19:40:00' => '07:40 PM', '19:45:00' => '07:45 PM', '19:50:00' => '07:50 PM', '19:55:00' => '07:55 PM',
                        '20:00:00' => '08:00 PM', '20:05:00' => '08:05 PM', '20:10:00' => '08:10 PM', '20:15:00' => '08:15 PM', '20:20:00' => '08:20 PM', '20:25:00' => '08:25 PM', '20:30:00' => '08:30 PM', '20:35:00' => '08:35 PM', '20:40:00' => '08:40 PM', '20:45:00' => '08:45 PM', '20:50:00' => '08:50 PM', '20:55:00' => '08:55 PM',
                        '21:00:00' => '09:00 PM', '21:05:00' => '09:05 PM', '21:10:00' => '09:10 PM', '21:15:00' => '09:15 PM', '21:20:00' => '09:20 PM', '21:25:00' => '09:25 PM', '21:30:00' => '09:30 PM', '21:35:00' => '09:35 PM', '21:40:00' => '09:40 PM', '21:45:00' => '09:45 PM', '21:50:00' => '09:50 PM', '21:55:00' => '09:55 PM',
                        '22:00:00' => '10:00 PM', '22:05:00' => '10:05 PM', '22:10:00' => '10:10 PM', '22:15:00' => '10:15 PM', '22:20:00' => '10:20 PM', '22:25:00' => '10:25 PM', '22:30:00' => '10:30 PM', '22:35:00' => '10:35 PM', '22:40:00' => '10:40 PM', '22:45:00' => '10:45 PM', '22:50:00' => '10:50 PM', '22:55:00' => '10:55 PM',
                        '23:00:00' => '11:00 PM', '23:05:00' => '11:05 PM', '23:10:00' => '11:10 PM', '23:15:00' => '11:15 PM', '23:20:00' => '11:20 PM', '23:25:00' => '11:25 PM', '23:30:00' => '11:30 PM', '23:35:00' => '11:35 PM', '23:40:00' => '11:40 PM', '23:45:00' => '11:45 PM', '23:50:00' => '11:50 PM', '23:55:00' => '11:55 PM',
                    );
                }


                //dd($time_array);
                /*if($dateValue==$currentDateValue)
                {

                $lastValue =  substr($timeValue, -1);
                $NolastValue =  substr($timeValue, 0, -1);
                $NewTimeValue = $NolastValue."0:00";
                $startIndex = $NewTimeValue;

                $positionIndex = array_search($startIndex, array_keys($time_array));

                $AllArray=array($dateValue,$timeValue,$currentDateValue,$currentTimeValue,$lastValue,$NolastValue,$NewTimeValue,$startIndex,$positionIndex);
                //dd($AllArray);
                $time_array = array_slice($time_array, $positionIndex+2, NULL, TRUE);

                }*/

                // dd($dateValue.'TFF'.$currentDateValue);
                if ($dateValue == $currentDateValue) {
                    $NewTimeValue = $timeValue . ":00";
                    // dd('TFF');
                    $currentTimeEpoch = strtotime($NewTimeValue);

                    foreach ($time_array as $key => $value) {
                        $timeSlotEpoch = strtotime($key);
                        if ($currentTimeEpoch > $timeSlotEpoch) {
                            unset($time_array[$key]);
                        }

                    }

                }else{
                    $time_array = null;
                    $sttime = strtotime($dateValue . " " . "00:00:00");
                    $stetime = strtotime($dateValue . " " . "23:45:00");
                    $eVdiff = ($stetime - $sttime) / 900; //300 sec means 5 for each patiant tim
                    //dd('hello'.$Evftime.''.$Evttime);
                    for ($i = 0; $i < $eVdiff; $i++) {
                        $time_array[date('H:i:s', $sttime + (900 * $i))] = date('h:i a', $sttime + (900 * $i));
                        $NewTimeValue = $timeValue . ":00";
                        // dd('TFF');
                        $currentTimeEpoch = strtotime($NewTimeValue);

                        foreach ($time_array as $key => $value) {
                            $timeSlotEpoch = strtotime($key);
                            if ($currentTimeEpoch > $timeSlotEpoch) {
                                unset($time_array[$key]);
                            }

                        }

                    }
                    //dd($time_array);

                }

            }else {

                // dd('else');
                $status = 0;
                $mftime = '';
                $mttime = '';
                foreach ($checkArray as $item) {
                    $status = $item->status;
                    $mftime = $item->available_from;
                    $mttime = $item->available_to;
                }
//dd($status);
                if ($status == 1) {
                    if ($AppointmentType == 1 || $AppointmentType == 2) {
                        $mftime = strtotime($dateValue . " " . $mftime);
                        $mttime = strtotime($dateValue . " " . $mttime);
                        $mdiff = ($mttime - $mftime) / 300; //300 sec means 5 for each patiant tim


                        for ($i = 0; $i <= $mdiff; $i++) {

                            $time_array[date('H:i:s', $mftime + (300 * $i))] = date('h:i a', $mftime + (300 * $i));
                        }


                    }
                    if ($AppointmentType == 3) {
                        $mftime = strtotime($dateValue . " " . $mftime);
                        $mttime = strtotime($dateValue . " " . $mttime);
                        $mdiff = ($mttime - $mftime) / 900; //900 sec means 15 for each patiant tim


                        for ($i = 0; $i <= $mdiff; $i++) {

                            $time_array[date('H:i:s', $mftime + (900 * $i))] = date('h:i a', $mftime + (900 * $i));
                        }


                    }
                    if ($dateValue == $currentDateValue) {
                        $NewTimeValue = $timeValue . ":00";

                        $currentTimeEpoch = strtotime($NewTimeValue);

                        foreach ($time_array as $key => $value) {
                            $timeSlotEpoch = strtotime($key);

                            if ($currentTimeEpoch > $timeSlotEpoch) {
                                unset($time_array[$key]);

                            }

                        }
                    }
                }
                else {
                    $time_array ['result']='Doctor Is Not Available';
                }
                // dd($time_array);

            }

            //$referralDoctors = $this->hospitalService->getDoctorsBySpecialty($specialtyId);
            //dd($referralDoctors);


            if(!is_null($time_array) && !empty($time_array))
            {

                $responseJson = new ResponsePrescription(ErrorEnum::SUCCESS, trans('messages.'.'Successfully retrived'));
                $responseJson->setCount(sizeof($time_array));
            }
            else
            {
                $responseJson = new ResponsePrescription(ErrorEnum::SUCCESS, trans('messages.'.'Failure While retrivng'));
            }

            $responseJson->setObj($time_array);
            $responseJson->sendSuccessResponse();
        }
        catch(HospitalException $hospitalExc)
        {
            //dd($hospitalExc);
            $responseJson = new ResponsePrescription(ErrorEnum::FAILURE, trans('messages.'.$hospitalExc->getUserErrorCode()));
            $responseJson->sendErrorResponse($hospitalExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $responseJson = new ResponsePrescription(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::REFERRAL_DOCTOR_LIST_ERROR));
            $responseJson->sendUnExpectedExpectionResponse($exc);
        }

        // dd($responseJson);
        return $responseJson;
    }



public function HealthCheck(){
    $doctors=null;
    try{

    } catch (Exception $userExc) {
        $errorMsg = $userExc->getMessageForCode();
        $msg = AppendMessage::appendMessage($userExc);
    } catch (Exception $exc) {
        //dd($exc);
        $msg = AppendMessage::appendGeneralException($exc);
        //error_log($status);
    }
    return view("healthCheck");
}
 public function update(\Illuminate\Http\Request $request)
    {
        if (session('userID') && time() - session('logintime') < 300) {


            $doctor_id = $request->get("doctor");
            $hospital_id = $request->get("hospital");
            $briefnote = $request->get("briefnote");
            $date = $request->get("date");
            $appointment_id = $request->get("appointment_id");

            //$timeslot = $request->get("timeslot");
            $timeslot = $request->get("appointmenttime");

            //$time_input = $timeslot;
            $tim = date('Y-m-d H:i:s', strtotime($date . " " . $timeslot));
            $findapprecord = DoctorAppointment::where('id',$appointment_id);

            $findapprecord->update(['doctor_id' => $doctor_id, 'brief_history' => $briefnote, 'appointment_date' => date('Y-m-d', strtotime($date)), 'appointment_time' => $tim]);
            $id = $appointment_id;

            $doctorappointments = DoctorAppointment::join('doctor', 'doctor.doctor_id', '=', 'doctor_appointment.doctor_id')->join('hospital', 'hospital.hospital_id', '=', 'doctor_appointment.hospital_id')->where('doctor_appointment.patient_id', '=', session('patient_id'))->where('doctor_appointment.id', '=', $id)->select('doctor.name', 'doctor.specialty', 'doctor_appointment.appointment_date', 'doctor_appointment.appointment_time as time', 'doctor_appointment.brief_history', 'hospital.hospital_name', 'hospital.email', 'hospital.address as hsaddress', 'hospital.telephone')->get();
          // dd($doctorappointments);
            $Doctorinfo =Doctor::where('doctor_id', '=', $doctor_id)->get();

// return  view("maillayout.doctor_appointment")->with('doctorappointments',$doctorappointments);

            $mails = array();
            if (session('email') != "") {
                $mails[count($mails)] = session('email');
            }
            if ($Doctorinfo[0]['email'] != "") {
                $mails[count($mails)] = $Doctorinfo[0]['email'];
            }

            if (count($mails) > 0) {
                Mail::send('maillayout.doctor_appointmentnew', ['doctorappointments' => $doctorappointments], function ($msg) use ($mails) {
                    $msg->subject('Updated Doctor Appointment');
                    $msg->from(session('email'));
                    $msg->to($mails);
                });
            }


            $mblno = '';
            if (session('patient_id') != "") {
                $patient = Patient::where('patient_id', '=', session('patient_id'))->get();
                if ($patient[0]['telephone'] != "") {
                    $mblno = $patient[0]['telephone'];
                }
            }
            if ($Doctorinfo[0]['telephone'] != "") {
                $mblno = $mblno . "," . $Doctorinfo[0]['telephone'];
            }
            if ($mblno != "") {
                $msg = "Patient ID:" . session('patient_id');
                $msg = $msg . "%0APatient Name: " . session('userID');
                $msg = $msg . "%0ADoctor Name: " . $doctorappointments[0]->name;
                $msg = $msg . "%0ADOA: " . $doctorappointments[0]->appointment_date;
                $msg = $msg . "%0ATOA: " . $doctorappointments[0]->time;
             //  Sms::sendMSG($mblno, $msg);
            }
             return view('doctor_appointmentnew',['date' => $date, 'briefnote' => $briefnote]);
          //  return redirect()->back()->with('msg', 'Successfully Updated Doctor Appointment.!');


        } else {
            $hospitals =Hospital::all();
            return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timeout Please Login again');
        }

        /**
         * Create a new controller instance.
         *
         * @return void**/

    }

/*
    public function cancel(\Illuminate\Http\Request $request)
    {
        if (session('userID') && time() - session('logintime') < 300) {


            $appointment_id = $request->get("appointment_id1");

            $findapprecord = \App\DoctorAppointment::find($appointment_id);


            $id = $findapprecord->id;
            $doctor_id = $findapprecord->doctor_id;
            $doctorappointments =DoctorAppointment::join('doctor', 'doctor.doctor_id', '=', 'doctor_appointment.doctor_id')->join('hospital', 'hospital.hospital_id', '=', 'doctor_appointment.hospital_id')->where('doctor_appointment.patient_id', '=', session('patient_id'))->where('doctor_appointment.id', '=', $id)->select('doctor.name', 'doctor.specialty', 'doctor_appointment.appointment_date', 'doctor_appointment.appointment_time as time', 'doctor_appointment.brief_history', 'hospital.hospital_name', 'hospital.email', 'hospital.address as hsaddress', 'hospital.telephone')->get();
            $Doctorinfo = Doctor::where('doctor_id', '=', $doctor_id)->get();
            //$findapprecord->delete();
// return  view("maillayout.doctor_appointment")->with('doctorappointments',$doctorappointments);

            $mails = array();
            if (session('email') != "") {
                $mails[count($mails)] = session('email');
            }
            if ($Doctorinfo[0]['email'] != "") {
                $mails[count($mails)] = $Doctorinfo[0]['email'];
            }

            if (count($mails) > 0) {
                Mail::send('maillayout.doctor_appointment', ['doctorappointments' => $doctorappointments], function ($msg) use ($mails) {
                    $msg->subject('Cancel Doctor Appointment');
                    $msg->from(session('email'));
                    $msg->to($mails);
                });
            }
            // return view('labmailtemplate',['date' => $date, 'briefnote' => $briefnote, 'labinfo' => $labinfo,'testinfo'=> $testinfo]);
            return redirect()->back()->with('msg', 'Successfully Cancel Doctor Appointment.!');
        } else {
            $hospitals = App\Hospital::all();
            return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timeout Please Login again');
        }

        /**
         * Create a new controller instance.
         *
         * @return void

    }
*/

    public function getHealthCheckupList(){
        $healthcheckups=null;
        $hospitals = null;
        try{
            $hospitals =Hospital::all();
            $healthcheckups=$this->doctorService->getHealthCheckupList();
            $labtest = $this->doctorService->getLabTestListforHealthCheckup();
            //dd($labtest);
        } catch (HospitalException $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return view('health-checkups')->with('hospitals', $hospitals)->with('healthcheckups', $healthcheckups)->with('labtest', $labtest);
    }

    public function bookHealthCheckup(Request $request){
        $packageId = null;
        try{
            $hospitals =Hospital::all();
            $packageId = $request->packageId;
            $packageName = $request->packageName;
            //dd($packageName);
        } catch (HospitalException $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return view('book-health-checkups')->with('hospitals', $hospitals)->with('packageId', $packageId)->with('packageName', $packageName);
    }

    public function saveHealthCheckup(Request $request){
        $status=null;
        try{
            $hospitals = Hospital::all();
            $healthcheckups=$this->doctorService->getHealthCheckupList();
            $labtest = $this->doctorService->getLabTestListforHealthCheckup();
            $status=$this->doctorService->saveHealthCheckup($request);
        } catch (HospitalException $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return redirect('healthcheckup')->with('msg', 'Your Query is submitted Successfully !');
        //return redirect()->back()->with('msg', 'Your Query is submitted Successfully !');
    }
}
