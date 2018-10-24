<?php

namespace App\patientportal\repositories\repositoryImpl;

use App\Http\ViewModels\NewAppointmentViewModel;
use App\Http\ViewModels\PatientProfileViewModel;
use App\patientportal\modal\Askquestion;
use App\patientportal\model\AskQuestionDocumentItems;
use App\patientportal\modal\Doctor;
use App\patientportal\modal\DoctorAppointment;
use App\patientportal\modal\Hospital;
use App\patientportal\modal\HospitalDoctor;
use App\patientportal\modal\Labappointment;
use App\patientportal\modal\Labtest;
use App\patientportal\modal\Patient;
use App\patientportal\modal\PharmacyAppointment;
use App\patientportal\modal\Role;
use App\patientportal\model\SecondOpinion;
use App\patientportal\model\SecondOpinionItems;
use App\patientportal\model\PatientHealthCheckup;
use App\patientportal\model\PatientOldDocuments;
use App\patientportal\modal\Sms;
use App\User;
use App\patientportal\repositories\repoInterface\DoctorInterface;
use App\patientportal\utilities\AppointmentType;
use App\patientportal\utilities\ErrorEnum\ErrorEnum;
use App\patientportal\utilities\UserType;
use Mockery\Exception;
use App\patientportal\utilities\Exception\UserNotFoundException;
use App\patientportal\utilities\Exception\HospitalException;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Numbers_Words;
use Storage;
use Carbon\Carbon;
use Config as CA;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/27/18
 * Time: 4:21 PM
 */
class DoctorImpl implements DoctorInterface
{

   public function BookDoctorAppointment(PatientProfileViewModel $patientProfileVM)
    {
       // dd('Inside save profile');
        $status = true;
        $user = null;
        $patientId = null;
        $patient = null;
        $hospitalPatient = null;
        $hospitalId = null;
        $doctorId = null;

        $patientUserId = null;
        $appointmentDate=null;
        $patientTokenId=null;
       // dd($patientProfileVM);

        try {
            $patientId = $patientProfileVM->getPatientId();
            $hospitalId = $patientProfileVM->getHospitalId();
            $doctorId = $patientProfileVM->getDoctorId();
            $appointmentDate=$patientProfileVM->getAppointmentDate();
            //dd($appointmentDate);
          // dd($patientId.$hospitalId.$doctorId);
            $hospitalUser = User::find($hospitalId);
          //dd($hospitalUser);

            if (is_null($hospitalUser)) {
                $status = false;
                throw new UserNotFoundException(null, ErrorEnum::HOSPITAL_USER_NOT_FOUND);
            }
            $doctorQuery = User::where('id', '=', $doctorId)->where('delete_status', '=', 1);

            $doctorUser = $doctorQuery->first();
            $patientTokenQuery = DB::table('doctor_appointment as dp');
            $patientTokenQuery->where('dp.hospital_id', '=', $hospitalId)->where('dp.doctor_id', '=', $doctorId);
            $patientTokenQuery->where('appointment_date','=',$appointmentDate);
            $patientTokenQuery->select(DB::raw('count(token_id) as token_count'))->get();
            $patientToken = $patientTokenQuery->first();
           // dd($patientToken);
            $patientTokenId = $patientToken->token_count;

            //dd($patientTokenId);
            //BY PARASANTH END 24-01-2018 //

            if (is_null($doctorUser)) {
                throw new UserNotFoundException(null, ErrorEnum::USER_NOT_FOUND, null);
            }
            //dd($patientId);

        /*    if ($patientId == 0) {
                $user = $this->registerNewPatient($patientProfileVM);
                $user = Role::find(UserType::USERTYPE_PATIENT);
                $patient = new Patient();
                $pid = $this->generateRandomString();
                $patient->pid = 'PID' . $pid;
                //$patient->pid = 'PID'.crc32(uniqid(rand()));
                $patient->email = $patientProfileVM->getEmail();

                $patientUserId = $user->id;
                $patient->patient_id =$patientUserId;
                $patient->name = $patientProfileVM->getName();
                $patient->address = $patientProfileVM->getAddress();
                $patient->occupation = $patientProfileVM->getOccupation();
                $patient->careof = $patientProfileVM->getCareOf();
                $patient->city = $patientProfileVM->getCity();
                $patient->country = $patientProfileVM->getCountry();
                $patient->telephone = $patientProfileVM->getTelephone();
                $patient->relationship = $patientProfileVM->getRelationship();
                $patient->patient_spouse_name = $patientProfileVM->getSpouseName();
                $patient->patient_photo = $patientProfileVM->getPatientPhoto();
                $patient->payment_status = $patientProfileVM->getPaymentStatus();
                $patient->dob = $patientProfileVM->getDob();
                $patient->age = $patientProfileVM->getAge();
                $patient->nationality = $patientProfileVM->getNationality();
                $patient->gender = $patientProfileVM->getGender();
                $patient->married = $patientProfileVM->getMaritalStatus();

                $patient->created_by = $patientProfileVM->getCreatedBy();
                $patient->created_at = $patientProfileVM->getCreatedAt();
                $patient->updated_by = $patientProfileVM->getUpdatedBy();
                $patient->updated_at = $patientProfileVM->getUpdatedAt();

                $user=$patient->save();


            } else {
                $patient = Patient::where('patient_id', '=', $patientId)->first();
                $patientUserId = $patient->patient_id;

                if (is_null($patient)) {
                    $status = false;
                    throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND);
                }

            }*/
            //BY PARASANTH START 24-01-2018 //
            $this->savePatientAppointment($patientProfileVM, $doctorUser, Session::get('patient_id'),$doctorId);



        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
           // throw new UserNotFoundException($queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            $status = false;
         //   throw new UserNotFoundException($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
          //  throw new UserNotFoundException($exc);
        }

        return $status;
        //return $patient;
    }
    private function savePatientAppointment(PatientProfileViewModel $patientProfileVM, User $doctorUser, $patientUserId)
    {
        //$appointments = $patientProfileVM->getAppointment();
//dd(Session::get('patient_id'));
        $appointmentStatus = AppointmentType::APPOINTMENT_OPEN;
        $doctorAppointment = new DoctorAppointment();

        $doctorAppointment->patient_id = Session::get('patient_id');
        $doctorAppointment->doctor_id = $patientProfileVM->getDoctorId();
        $doctorAppointment->hospital_id = $patientProfileVM->getHospitalId();
        $doctorAppointment->brief_history = $patientProfileVM->getBriefHistory();
        $doctorAppointment->appointment_date = $patientProfileVM->getAppointmentDate();
        $doctorAppointment->appointment_time = $patientProfileVM->getAppointmentTime();
        $doctorAppointment->appointment_category = $patientProfileVM->getAppointmentCategory();
        $doctorAppointment->appointment_status_id = $appointmentStatus;
        //BY PRASANTH 24-01-2018 START//
        //we are adding+1 for existing count value for display current TokenID
        // $patientTokenId=intval($patientTokenId)+1;


        $patientTokenId = $this->generateTokenId($patientProfileVM->getHospitalId(), $patientProfileVM->getDoctorId(), $patientProfileVM->getAppointmentDate());
        //dd($patientTokenId);
        //$patientTokenId=intval($patientTokenId)+1;
        $doctorAppointment->token_id = $patientTokenId;
        //BY PRASANTH 24-01-2018 END//
        $doctorAppointment->referral_type = $patientProfileVM->getReferralType();
        $doctorAppointment->referral_doctor = $patientProfileVM->getReferralDoctor();
        $doctorAppointment->referral_hospital = $patientProfileVM->getReferralHospital();
        $doctorAppointment->referral_hospital_location = $patientProfileVM->getHospitalLocation();
        $doctorAppointment->fee = $patientProfileVM->getAmount();
        $doctorAppointment->payment_type = $patientProfileVM->getPaymentType();
        $doctorAppointment->is_from_patient_portal = '1';
        $doctorAppointment->created_by = $patientProfileVM->getCreatedBy();
        $doctorAppointment->modified_by = $patientProfileVM->getUpdatedBy();
        $doctorAppointment->created_at = $patientProfileVM->getCreatedAt();
        $doctorAppointment->updated_at = $patientProfileVM->getUpdatedAt();

        $doctorUser=$doctorAppointment->save();


    }
    private function generateTokenId($hospitalId, $doctorId, $appointmentDate)
    {
        //$defaultTokenId = trans('constants.token_id');
        $defaultTokenId =1;
//dd($defaultTokenId);
        //$maxVal = 0;

        /*$maxId = DB::table('doctor_appointment')->max('token_id');*/

       // dd('test');
        $maxId =DoctorAppointment::where('hospital_id', '=', $hospitalId)
            ->where('doctor_id', '=', $doctorId)
            ->where('appointment_date','=',$appointmentDate)->max('token_id');


        if($maxId == 0 || $maxId == "")
        {
            //$maxVal = intval($defaultValue);
          //  dd($defaultTokenId);
            $maxVal = $defaultTokenId;
        }
        else
        {
            $maxVal = $maxId + 1;
          //  dd($maxVal);
        }

        return $maxVal;
    }

    private function registerNewPatient(PatientProfileViewModel $patientProfileVM)
    {
        $user = null;
        $patientId = $patientProfileVM->getPatientId();

        if ($patientId == 0) {
            $user = new User();
        } else {
            $user = User::find($patientId);
        }

        $user->name = $patientProfileVM->getName();
        $user->email = $patientProfileVM->getEmail();
        $user->password = $patientProfileVM->getName();
        $user->delete_status = 1;
        $user->created_at = $patientProfileVM->getCreatedAt();
        $user->updated_at = $patientProfileVM->getUpdatedAt();

        $user->save();

        return $user;
    }

    private function attachPatientRole(User $user)
    {
        $role = Role::find(UserType::USERTYPE_PATIENT);


        if (!is_null($role)) {
            // dd($role);
            $user->attachRole($role);
        }
    }
    private function generateRandomString($length = 9) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getHospitalsList($speciality, $doctorId)
    {
        $hospitals = null;
        try {
            $query = HospitalDoctor::join('hospital', 'hospital.hospital_id', '=', 'hospital_doctor.hospital_id');
            $query->join('doctor', 'doctor.doctor_id', '=', 'hospital_doctor.doctor_id');
            $query->where('hospital_doctor.doctor_id', '=', $doctorId);

            $hospitals = $query->get();


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

    public function getAddress($speciality, $doctorId, $hospitalId)
    {
        $hospitals = null;
        try {
            $query = HospitalDoctor::where('doctor_id', '=', $doctorId);
            $query->join('hospital', 'hospital.hospital_id', '=', 'hospital_doctor.hospital_id');
            $query->where('hospital.hospital_id', '=', $hospitalId);


            $hospitals = $query->get();


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

    public function getDoctorsList($request)
    {
        $doctors = null;
        try {
            $splecialty = $request->input('specialty');
         //   dd($splecialty."=========");
            if ($splecialty != "") {
                $doctors = Doctor::where('specialty', '=', $splecialty)->get();
            } else {
                $doctors =  Doctor::all();
            }


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

    public function getDoctors()
    {
        $doctors = null;
        try {
            $doctors = Doctor::all();


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

    public function getDoctorAvailability($request)
    {

        $specialty = $request->input("specialty");
        $doctor_id = $request->input("doctor_id");
        $hsp_id = $request->input("hsp_id");
        $date = $request->input('date');
        $day = strtolower(date('D', strtotime($date)));
        $availability = DB::select('select morning,evening from doctor_availability where doctor_id=? and hospital_id=? and day=?', [$doctor_id, $hsp_id, $day]);
        $todayappointments = DoctorAppointment::where('appointment_date', '=', date('Y-m-d', strtotime($date)))->where('doctor_id', '=', $doctor_id)->where('hospital_id', '=', $hsp_id)->select('appointment_time as time', 'appointment_date as date')->get();
        $mrng = explode('to', $availability[0]->morning);
        $mftime = strtotime(str_replace("/", "-", $date) . " " . $mrng[0]);
        $mttime = strtotime(str_replace("/", "-", $date) . "  " . $mrng[1]);
        $mdiff = ($mttime - $mftime) / 900; //900 sec means 15 for each patiant tim
        $timeslots = array();
        $tindx = 0;
        // echo  $todayappointments;
        //echo $date . " " . $mrng[0]." ".strtotime($date . " " . $mrng[0]);
        for ($i = 0; $i <= $mdiff; $i++) {
            $match = false;
            for ($m = 0; $m < count($todayappointments); $m++) {
                //echo strtotime($todayappointments[$m]['date']." ".$todayappointments[$m]['time']);
                if ($mftime + (900 * $i) == strtotime($todayappointments[$m]['date'] . " " . $todayappointments[$m]['time'])) {
                    $match = true;
                    break;
                    // $timeslots['mrng'][$tindx++] = date('h:i', $mftime + (900 * $i));
                }
            }
            if ($match != true) {
                $timeslots['mrng'][$tindx++] = date('h:i', $mftime + (900 * $i));
            }
        }

        $evng = explode('to', $availability[0]->evening);
        $eftime = strtotime(str_replace("/", "-", $date) . " " . $evng[0]);
        $ettime = strtotime(str_replace("/", "-", $date) . "  " . $evng[1]);
        $ediff = ($ettime - $eftime) / 900; //900 sec means 15 for each patiant tim

        // $timeslots=array();
        $tindx = 0;
        for ($i = 0; $i < $ediff; $i++) {
            $match = false;
            for ($m = 0; $m < count($todayappointments); $m++) {
                // echo strtotime( $todayappointments[$m]['time'])."--<br>";
                if ($eftime + (900 * $i) == strtotime($todayappointments[$m]['date'] . " " . $todayappointments[$m]['time'])) {
                    $match = true;
                    break;
                    // $timeslots['mrng'][$tindx++] = date('h:i', $mftime + (900 * $i));
                }
            }
            if ($match != true) {
                $timeslots['evng'][$tindx++] = date('H:i', $eftime + (900 * $i));
            }
            // echo $eftime + (900 * $i);
            // $timeslots['evng'][$tindx++] = date('h:i', $eftime + (900 * $i));
        }

        //return $availability;
        return $timeslots;


    }

    public function getAppointment($request)
    {
        $doctors = null;
        try {
            session(['methode' => $request->input('methode')]);
            $specialty = Doctor::select('specialty')->distinct()->get();
            //return $specialty;
            $typeoftest = Labtest::select('test_category')->distinct()->get();
            $hospitals = Hospital::all();
            $totalInfo['specialty']=$specialty;
            $totalInfo['typeoftest']=$typeoftest;
            $totalInfo['hospitals']=$hospitals;
        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
      //  return view('appointment')->with('specialty', $specialty)->with('typeoftest', $typeoftest)->with('hospitals', $hospitals);
return $totalInfo;
    }



    public function getAppointments()
    {
        $labappointments=null;
        try{
            $labappointments = Labappointment::join('lab', 'lab.lab_id', '=', 'lab_appointment.lab_id')
                ->join('hospital', 'hospital.hospital_id', '=', 'lab_appointment.hospital_id')
                ->where('lab_appointment.patient_id', '=', session('patient_id'))
                ->select('lab_appointment.id', 'lab_appointment.appointment_date', 'lab.name', 'hospital.hospital_name')
                ->paginate(10);


        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            $msg = AppendMessage::appendGeneralException($exc);

        }
       return $labappointments;
    }

public function getAskQuestions()
{
    $askquestions=null;
    try{
        $askquestions =  Askquestion::join('doctor', 'doctor.doctor_id', '=', 'patient_ask_question.doctor_id')
            ->join('hospital', 'hospital.hospital_id', '=', 'patient_ask_question.hospital_id')
            ->where('patient_ask_question.patient_id', '=', session('patient_id'))
            ->select('patient_ask_question.created_at', 'doctor.name', 'doctor.doctor_id', 'hospital.hospital_name', 'doctor.specialty')
            ->paginate(10);



    } catch (Exception $userExc) {
        $errorMsg = $userExc->getMessageForCode();
        $msg = AppendMessage::appendMessage($userExc);

    } catch (Exception $exc) {
        $msg = AppendMessage::appendGeneralException($exc);

    }
    return $askquestions;
}

public function getPharmacyAppointments()
{
    $pharmacyappointments=null;
    try{
        $pharmacyappointments =  DB::table('pharmacy_pickup')->join('pharmacy_pickup_documents', 'pharmacy_pickup.id', '=', 'pharmacy_pickup_documents.pharmacy_pickup_id')
            ->join('hospital', 'hospital.hospital_id', '=', 'pharmacy_pickup.hospital_id')
            ->join('pharmacy as p','p.pharmacy_id','=','pharmacy_pickup.pharmacy_id')
            ->where('pharmacy_pickup.patient_id', '=', session('patient_id'))
            ->select('pharmacy_pickup.id', 'pharmacy_pickup.brief_notes', 'pharmacy_pickup.pickup_date as appointment_date', 'hospital.hospital_name','p.name')
            ->paginate(10);


    } catch (Exception $userExc) {
        $errorMsg = $userExc->getMessageForCode();
        $msg = AppendMessage::appendMessage($userExc);

    } catch (Exception $exc) {
        $msg = AppendMessage::appendGeneralException($exc);

    }
    return $pharmacyappointments;
}

    public function getDoctorAppointment()
    {
        $doctorappointments=null;
        try{
            $doctorappointments = DoctorAppointment::join('doctor', 'doctor.doctor_id', '=', 'doctor_appointment.doctor_id')
                ->join('hospital', 'hospital.hospital_id', '=', 'doctor_appointment.hospital_id')
                ->where('doctor_appointment.patient_id', '=', session('patient_id'))
                ->select('doctor_appointment.id', 'doctor_appointment.appointment_date', 'doctor_appointment.appointment_time as time', 'doctor.name', 'hospital.hospital_name', 'doctor.specialty')
                ->paginate(10);


        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            $msg = AppendMessage::appendGeneralException($exc);

        }
        return $doctorappointments;
    }

    public function getLabDates()
    {
        $labappointments=null;
        $examinationDates=null;

        try{
            $patientId=session('patient_id');


            $bloodDatesQuery = DB::table('patient_blood_examination as pbe')->where('pbe.patient_id', '=', $patientId);
            $bloodDatesQuery->join('hospital as h ','h.hospital_id','=','pbe.hospital_id');
            $bloodDatesQuery->select('pbe.examination_date','h.hospital_id','hospital_name','pbe.examination_time')->orderBy('pbe.examination_date', 'DESC');
            $bloodTestDates = $bloodDatesQuery->distinct()->get();

            $urineDatesQuery = DB::table('patient_urine_examination as pue')->where('pue.patient_id', '=', $patientId);
            $urineDatesQuery->join('hospital as h ','h.hospital_id','=','pue.hospital_id');
            $urineDatesQuery->select('pue.examination_date','h.hospital_id','hospital_name','pue.examination_time')->orderBy('pue.examination_date', 'DESC');
            $urineTestDates = $urineDatesQuery->distinct()->get();

            $motionDatesQuery = DB::table('patient_motion_examination as pme')->where('pme.patient_id', '=', $patientId);
            $motionDatesQuery->join('hospital as h ','h.hospital_id','=','pme.hospital_id');
            $motionDatesQuery->select('pme.examination_date','h.hospital_id','hospital_name','pme.examination_time')->orderBy('pme.examination_date', 'DESC');
            $motionTestDates = $motionDatesQuery->distinct()->get();

            $ultraDatesQuery = DB::table('patient_ultra_sound as pus')->where('pus.patient_id', '=', $patientId);
            $ultraDatesQuery->join('hospital as h', 'h.hospital_id','=','pus.hospital_id');
            $ultraDatesQuery->select('pus.examination_date','h.hospital_id','hospital_name','pus.examination_time')->orderBy('pus.examination_date', 'DESC');
            $ultraSoundTestDates = $ultraDatesQuery->distinct()->get();
            //dd($ultraSoundTestDates);

            $scanDatesQuery = DB::table('patient_scan as pscan')->where('pscan.patient_id', '=', $patientId);
            $scanDatesQuery->join('hospital as h', 'h.hospital_id','=','pscan.hospital_id');
            $scanDatesQuery->select('pscan.scan_date','h.hospital_id','hospital_name','pscan.examination_time')->orderBy('pscan.scan_date', 'DESC');
            $scanTestDates = $scanDatesQuery->distinct()->get();

            $xrayDatesQuery = DB::table('patient_xray_examination as pxray')->where('pxray.patient_id', '=', $patientId);
            $xrayDatesQuery->join('hospital as h', 'h.hospital_id','=','pxray.hospital_id');
            $xrayDatesQuery->select('pxray.examination_date','h.hospital_id','hospital_name','pxray.examination_time')->orderBy('pxray.examination_date', 'DESC');
            $xrayTestDates = $xrayDatesQuery->distinct()->get();

            $denatlDatesQuery = DB::table('patient_dental_examination as pdental')->where('pdental.patient_id', '=', $patientId);
            $denatlDatesQuery->join('hospital as h', 'h.hospital_id','=','pdental.hospital_id');
            $denatlDatesQuery->select('pdental.examination_date','h.hospital_id','hospital_name','pdental.examination_time')->orderBy('pdental.examination_date', 'DESC');
            $dentalTestDates = $denatlDatesQuery->distinct()->get();

            $examinationDates["bloodTestDates"] = $bloodTestDates;
            $examinationDates["urineTestDates"] = $urineTestDates;
            $examinationDates["motionTestDates"] = $motionTestDates;
            $examinationDates["ultraSoundTestDates"] = $ultraSoundTestDates;
            $examinationDates["scanTestDates"] = $scanTestDates;
            $examinationDates["xrayTestDates"] = $xrayTestDates;
            $examinationDates["dentalTestDates"] = $dentalTestDates;
            // dd($examinationDates);

            $latestBloodExamQuery = DB::table('patient_blood_examination as pbe');
            $latestBloodExamQuery->join('patient_blood_examination_item as pbei', 'pbei.patient_blood_examination_id', '=', 'pbe.id');
            $latestBloodExamQuery->join('blood_examination as be', 'be.id', '=', 'pbei.blood_examination_id');
            $latestBloodExamQuery->where('pbe.examination_date', function ($query) use ($patientId) {
                $query->select(DB::raw('MAX(pbe.examination_date)'));
                $query->from('patient_blood_examination as pbe')->where('pbe.patient_id', '=', $patientId);
            });
            $latestBloodExamQuery->where('pbe.examination_time', function ($query) use ($patientId) {
                $query->select(DB::raw('MAX(pbe.examination_time)'));
                $query->from('patient_blood_examination as pbe')->where('pbe.patient_id', '=', $patientId);
                $query->where('pbe.examination_date', function ($query1) use ($patientId) {
                    $query1->select(DB::raw('MAX(pbe.examination_date)'));
                    $query1->from('patient_blood_examination as pbe')->where('pbe.patient_id', '=', $patientId);
                });
            });
            $latestBloodExamQuery->where('pbe.patient_id', '=', $patientId);
            $latestBloodExamQuery->where('pbei.is_value_set', '=', 1);
            $latestBloodExamQuery->select('pbe.id as examinationId', 'pbei.id as examinationItemId', 'pbe.patient_id',
                'pbe.hospital_id', 'be.examination_name', 'pbe.examination_date');
            $bloodExaminations = $latestBloodExamQuery->get();
        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            $msg = AppendMessage::appendGeneralException($exc);

        }
        return $examinationDates;
    }
    public function AskQuestionPage(){

        $specialty=null;
        try{

            $specialty = DB::table('specialty')->select('id','specialty_name as specialty')->get();


        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $specialty;
    }

    public function saveSecondOpinion($request)
    {
        //dd($request->all());
        $OrgfileName=null;
        $fileType=null;
        try{
            $specialist = $request->get("specialist");
            $doctor1 = $request->get("doctor");
            $hospital = $request->get("hospital");
            $subject = $request->get("Subject");
            $message = $request->get("Message");
            //$questiontype = $request->get("questiontype");
            $patient_id = session('patient_id');
            $patientname = session('userID');
            $priority = $request->get("expectedtime");
            $path='';
            $nooffiles=0;

            $SecondOpinion=new SecondOpinion();
            //dd($SecondOpinion);
            $SecondOpinion->patient_id = $patient_id;
            $SecondOpinion->specialty_id = $specialist;
            $SecondOpinion->doctor_id = $doctor1;
            $SecondOpinion->hospital_id = $hospital;
            $SecondOpinion->subject = $subject;
            $SecondOpinion->so_priority_id = $priority;
            $SecondOpinion->detailed_description = $message;
            $SecondOpinion->created_by = 'Admin';
            $SecondOpinion->updated_by = 'Admin';
            $SecondOpinion->save();

            if ($request->hasFile('image')) {
                $files= $request->file('image');
                foreach ($files as $file){
                    $randomName = $this->generateUniqueFileName();
                    $fileType= $file->getClientOriginalExtension();
                    $OrgfileName=$file->getClientOriginalName();
                    $filename=$patient_id.$randomName.'.'.$file->getClientOriginalExtension();
                    $path=$path.$filename."@@";
                    $destinationPath = 'public/askquestion'; // upload path
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(11111,99999).'.'.$extension; // renaming image
                    $path = $filename;
                    // dd($filename.'-------'.$destinationPath);
                    $file->move($destinationPath, $filename);
                }

                $SecondOpinionItems=new SecondOpinionItems();
                $SecondOpinionItems->patient_second_opinion_id=$SecondOpinion->id;
                $SecondOpinionItems->document_path=$path;
                $SecondOpinionItems->document_filename=$OrgfileName;
                $SecondOpinionItems->document_extension=$fileType;
                $SecondOpinionItems->document_upload_status="1";
                $SecondOpinionItems->created_by = 'Admin';
                $SecondOpinionItems->updated_by = 'Admin';
                //$AskQuestionDocumentItems->patient_ask_question_id="";
                $SecondOpinionItems->save();
            }


            $dc = Doctor::where('doctor_id', '=', $doctor1)->get();
            //$hospitalinfo = App\HospitalDoctor ::where('doctor_id', '=', $doctor1)->join('hospital', 'hospital.hospital_id', '=', 'hospital_doctor.hospital_id')->where('hospital.hospital_id', '=', $hospital)->get();

            $did=$doctor1;
            $date=$SecondOpinion->created_at;
            //dd($date);
            $askquestions=DB::table('patient_second_opinion as pso')
                ->join('doctor as d','d.doctor_id','=','pso.doctor_id')
                ->join('hospital as h','h.hospital_id','=','pso.hospital_id')
                ->join('patient_second_opinion_documents as psoi','psoi.patient_second_opinion_id','=','pso.id')
                ->where('pso.patient_id','=',session('patient_id'))
                ->where('pso.doctor_id','=',$did)
                ->where('pso.created_at','=',$date)
                ->select('d.name','d.specialty','pso.created_at as appointment_date','pso.detailed_description as brief_history','h.hospital_name','h.email','h.address as hsaddress','h.telephone','psoi.document_path as reports','pso.subject')->get();

            //$doctorappointments=\App\DoctorAppointment::join('doctor','doctor.doctor_id','=','doctor_appointment.doctor_id')->join('hospital','hospital.hospital_id','=','doctor_appointment.hospital_id')->where('doctor_appointment.patient_id','=',session('patient_id'))->where('doctor_appointment.id','=',$id)->select('doctor.name','doctor.specialty','doctor_appointment.appointment_date','doctor_appointment.brief_history','hospital.hospital_name','hospital.email','hospital.address as hsaddress','hospital.telephone')->get();
            //return  view("maillayout.doctor_appointment")->with('doctorappointments',$askquestions);
            $mails=array();
            if(session('email')!="")   {
                $mails[count($mails)]=session('email');
            }
            $questiontype="SecondOpinion";
            if($dc[0]->email!=""){
                $mails[count($mails)]=$dc[0]->email;
            }

            if(count($mails)>0){
                Mail::send('maillayout.ask_appointment', ['doctorappointments' =>  $askquestions], function($msg) use($mails,$questiontype) {
                    $msg->subject($questiontype);
                    $msg->from(session('email'));
                    $msg->to($mails);
                });
            }

            $mblno='';
            if(session('patient_id')!=""){
                $patient=Patient::where('patient_id', '=', session('patient_id'))->get();
                if($patient[0]['telephone']!=""){
                    $mblno=$patient[0]['telephone'];
                }
            }

            if ($dc[0]->telephone != "") {
                $mblno =$mblno.",".$dc[0]->telephone;
            }

            if($mblno!=""){
                $msg="Patient ID:".session('patient_id');
                $msg=$msg."%0APatient Name:".session('userID');
                $msg=$msg."%0ADoctor Name:".$askquestions[0]->name;
                $msg=$msg."%0ABrief Note:".$askquestions[0]->brief_history;
                $msg=$msg."%0ADOA:".$askquestions[0]->appointment_date;
                // dd('Test');
                Sms::sendMSG($mblno, $msg);
            }
        }
        catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return "true";
    }



/*To Save Patient Question  */

     public function saveQuestion($request) {
           $filename=null;
           $fileType=null;
 //dd($request);
         $path='';
         try{

        $specialist = $request->get("specialist");
        $doctor1 = $request->get("doctor");
        $hospital = $request->get("hospital");
        $subject = $request->get("Subject");
        $message = $request->get("Message");
        $questiontype = $request->get("questiontype");
        $patient_id = session('patient_id');
        $patientname = session('userID');
        $priority = $request->get("expectedtime");

        $askquestion=new Askquestion();
        $askquestion->patient_id = $patient_id;
        $askquestion->specialty_id= $specialist;
        $askquestion->doctor_id = $doctor1;
        $askquestion->hospital_id = $hospital;
        $askquestion->priority_id = $priority;
        $askquestion->subject = $subject;
        $askquestion->detailed_description = $message;
        $askquestion->created_by = 'Admin';
        $askquestion->updated_by = 'Admin';
        $askquestion->save();

            if ($request->hasFile('image')) {

                $files= $request->file('image');
                foreach ($files as $file){
                    $fileType= $file->getClientOriginalExtension();
                    $OrgfileName=$file->getClientOriginalName();
                    $randomName = $this->generateUniqueFileName();
                    $filename=$patient_id.$randomName.'.'.$file->getClientOriginalExtension();
                    $path=$path.$filename."@@";
                    $destinationPath = 'public/askquestion'; // upload path
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(11111,99999).'.'.$extension; // renaming image
                    $path = $filename;
                    // dd($filename.'-------'.$destinationPath);
                    $file->move($destinationPath, $filename);

                $AskQuestionDocumentItems=new AskQuestionDocumentItems();
                $AskQuestionDocumentItems->patient_ask_question_id=$askquestion->id;
                $AskQuestionDocumentItems->document_path=$path;
                $AskQuestionDocumentItems->document_filename=$OrgfileName;
                $AskQuestionDocumentItems->document_extension=$fileType;
                $AskQuestionDocumentItems->document_upload_status="1";
                $AskQuestionDocumentItems->created_by = 'Admin';
                $AskQuestionDocumentItems->updated_by = 'Admin';
                $AskQuestionDocumentItems->save();

            }

        }
        $dc = Doctor::where('doctor_id', '=', $doctor1)->get();
        $did=$doctor1;
        $date=$askquestion->created_at;
        $askquestions=DB::table('patient_ask_question as paq')
            ->join('doctor as d','d.doctor_id','=','paq.doctor_id')
            ->join('hospital as h','h.hospital_id','=','paq.hospital_id')
            ->join('patient_ask_question_documents as paqi','paqi.patient_ask_question_id','=','paq.id')
            ->where('paq.patient_id','=',session('patient_id'))
            ->where('paq.doctor_id','=',$did)
            ->where('paq.created_at','=',$date)
            ->select('d.name','d.specialty','paq.created_at as appointment_date','paq.detailed_description as brief_history','h.hospital_name','h.email','h.address as hsaddress','h.telephone','paqi.document_path as reports','paq.subject')->get();

        $mails=array();
        if(session('email')!="")   {
            $mails[count($mails)]=session('email');
        }
        if($dc[0]->email!=""){
            $mails[count($mails)]=$dc[0]->email;
        }

        if(count($mails)>0){
            Mail::send('maillayout.ask_appointment', ['doctorappointments' =>  $askquestions], function($msg) use($mails,$questiontype) {
                $msg->subject($questiontype);
                $msg->from(session('email'));
                $msg->to($mails);
            });
        }

        $mblno='';
        if(session('patient_id')!=""){
            $patient=Patient::where('patient_id', '=', session('patient_id'))->get();
            if($patient[0]['telephone']!=""){
                $mblno=$patient[0]['telephone'];
            }
        }
        if ($dc[0]->telephone != "") {
            $mblno =$mblno.",".$dc[0]->telephone;
        }

        if($mblno!=""){
            $msg="Patient ID:".session('patient_id');
            $msg=$msg."%0APatient Name:".session('userID');
            $msg=$msg."%0ADoctor Name:".$askquestions[0]->name;
            $msg=$msg."%0ABrief Note:".$askquestions[0]->brief_history;
            $msg=$msg."%0ADOA:".$askquestions[0]->appointment_date;
           // dd('Test');
            Sms::sendMSG($mblno, $msg);
        }

         } catch (Exception $userExc) {

             $errorMsg = $userExc->getMessageForCode();
             dd($userExc);
             $msg = AppendMessage::appendMessage($userExc);


         } catch (Exception $exc) {
             dd($exc);
             $msg = AppendMessage::appendGeneralException($exc);
             //error_log($status);
         }
         return "true";

    }

    private function generateUniqueFileName()
    {
        $i = 0;
        $randomString = mt_rand(1, 9);
        do {
            $randomString .= mt_rand(0, 9);
        } while (++$i < 7);

        return $randomString;
    }

    /*To Get Single Doctor Selected Information*/


    public function getSingleDoctor($request)
    {
        $Alldata = null;
        try {



            $doctor_id = $request->input("doctorid");

            $totaldoctorinfo = DB::table('hospital_doctor as hd')
                ->join('hospital as h', 'h.hospital_id', '=', 'hd.hospital_id')
                ->where('h.hospital_id', '=', 'hd.hospital_id')
                ->where('hd.doctor_id', '=', $doctor_id)
                ->select('h.hospital_name')->get();

            $doctor_hosptilas = HospitalDoctor::where('doctor_id', '=', $doctor_id)->get();
            $hospitalids = array();

            foreach ($doctor_hosptilas as $hs) {
                $hospitalids[count($hospitalids)] = $hs->hospital_id;
            }


            $hospital = Hospital::whereIn('hospital_id', $hospitalids)->get();

            $doctors = DB::table('doctor')
                ->join('specialty','specialty.specialty_name','=','doctor.specialty')
                ->where('doctor.doctor_id', '=', $doctor_id)
                ->select('doctor.doctor_id','doctor.name','doctor.address','doctor.doctor_photo','doctor.qualifications','doctor.designation','specialty.id')->get();
            $hospitals = Hospital::all();

            $Alldata['doctorinfo']=$totaldoctorinfo;
            $Alldata['hospital']=$hospital;
            $Alldata['allhospital']=$hospitals;
            $Alldata['doctors']=$doctors;


        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        //dd($Alldata);
        return $Alldata;
    }



    public function getTokenIdByHospitalIdandDoctorId($hospitalId,$doctorId,$date,$type){
        $patientTokenId = null;

        try
        {
           // dd($type);
            $patientTokenQuery = DB::table('doctor_appointment as dp');
            $patientTokenQuery->where('dp.hospital_id', '=', $hospitalId)->where('dp.doctor_id', '=', $doctorId)->where('dp.appointment_date','=',$date)->where('dp.appointment_category','=',$type);
            $patientTokenQuery->select(DB::raw('count(token_id) as token_count'))->get();
            $patientTokenId=$patientTokenQuery->first();
            // dd($date);
            //  dd($patientTokenQuery->toSql().Carbon::now()->format('Y-m-d'));
//dd($patientTokenId);

            if(count($patientTokenId)>0) {
                $patientTokenId = intval($patientTokenId['token_count']) + 1;
                //  dd($patientTokenId);
            }else{
                $patientTokenId=1;
            }

        }
        catch(QueryException $queryEx)
        {
            //dd($queryEx);
            throw new UserNotFoundException(null, ErrorEnum::PATIENT_REPORTS_LIST_ERROR, $queryEx);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            throw new UserNotFoundException(null, ErrorEnum::PATIENT_REPORTS_LIST_ERROR, $exc);
        }
//dd($patientTokenId);RTGFDS
        return $patientTokenId;

    }

    public function getHospitalDoctors($hospitalId)
    {
        $doctors = null;
        try {
            //   dd($splecialty."=========");
                $doctors = DB::table('doctor as d')
                    ->join('hospital_doctor as hd','hd.doctor_id','=','d.doctor_id')
                    ->where('hd.hospital_id', '=', $hospitalId)
                    ->select('d.doctor_id as doctor_id','d.name')->get();


        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        //dd($doctors);
        return $doctors;
    }

    public function getHealthCheckupList()
    {
        $healthcheckups = null;
        try {
            $query = DB::table('health_packages as hp');
            $query->where('hp.package_status','=','1');
            $healthcheckups = $query->get();
        } catch(HospitalException $hospitalExc)
        {
            throw $hospitalExc;
        }
        catch(Exception $exc)
        {
            throw new HospitalException(null, ErrorEnum::HEALTH_CHECKUPS_LIST_ERROR, $exc);
        }
        return $healthcheckups;
    }

    public function getLabTestListforHealthCheckup()
    {
        $healthcheckups = null;
        try {
            $query = DB::table('labtest as lt')->select('lt.*','ltp.package_id');
            $query->rightjoin('lab_test_package as ltp','ltp.lab_test_id','=','lt.id');
            $query->leftjoin('health_packages as hp','hp.id','=','ltp.package_id');
            $query->where('lt.test_status','=','1');
            $healthcheckups = $query->get();
        } catch(HospitalException $hospitalExc)
        {
            throw $hospitalExc;
        }
        catch(Exception $exc)
        {
            throw new HospitalException(null, ErrorEnum::HEALTH_CHECKUPS_LIST_ERROR, $exc);
        }
        return $healthcheckups;
    }

    public function saveHealthCheckup($request)
    {
        //dd($request->all());
        try{
            $patientName = $request->get("patientName");
            $referral = $request->get("referral");
            $hospital = $request->get("hospital");
            $emailId = $request->get("emailId");
            $mobile = $request->get("mobile");
            $date = $request->get("date");
            $packageId = $request->get("packageId");
            $patient_id = session('patient_id');
            $userName = session('userID');

            $healthCheckup = new PatientHealthCheckup();
            $healthCheckup->package_id = $packageId;
            $healthCheckup->patient_id = $patient_id;
            $healthCheckup->patient_name = $patientName;
            $healthCheckup->referral = $referral;
            $healthCheckup->hospital_name = $hospital;
            $healthCheckup->email_id = $emailId;
            $healthCheckup->mobile = $mobile;
            $healthCheckup->appointment_date = $date;
            $healthCheckup->created_by = $userName;
            $healthCheckup->updated_by = $userName;
            $healthCheckup->save();

            $checkup=DB::table('patient_health_checkup as phc')
                ->join('health_packages as hp','hp.id','=','phc.package_id')
                ->where('phc.patient_id','=',session('patient_id'))
                ->select('phc.*','hp.package_name')->get();

            $mails=array();
            if(session('email')!="")   {
                $mails[count($mails)]=session('email');
            }
            $questiontype="HealthCheckup";

            if(count($mails)>0){
                Mail::send('maillayout.health_checkup_mail', ['doctorappointments' =>  $checkup], function($msg) use($mails,$questiontype) {
                    $msg->subject($questiontype);
                    $msg->from(session('email'));
                    $msg->to($mails);
                });
            }

            $mblno='';
            if(session('patient_id')!=""){
                $patient=Patient::where('patient_id', '=', session('patient_id'))->get();
                if($patient[0]['telephone']!=""){
                    $mblno=$patient[0]['telephone'];
                }
            }

            if ($checkup[0]->mobile != "") {
                $mblno =$mblno.",".$checkup[0]->mobile;
            }

            if($mblno!=""){
                $msg="Patient ID:".session('patient_id');
                $msg=$msg."%0APatient Name:".$checkup[0]->patient_name;
                $msg=$msg."%0AHospital Name:".$checkup[0]->hospital_name;
                $msg=$msg."%0AHealth Checkup:".$checkup[0]->package_name;
                $msg=$msg."%0ADOA:".$checkup[0]->appointment_date;
                Sms::sendMSG($mblno, $msg);
            }
        }
        catch(HospitalException $hospitalExc)
        {
            throw $hospitalExc;
        }
        catch(Exception $exc)
        {
            throw new HospitalException(null, ErrorEnum::HEALTH_CHECKUPS_SAVE_ERROR, $exc);
        }
        return "true";
    }

    public function getPatientHealthCheckups()
    {
        $healthcheckups = null;
        try {
            $query = DB::table('patient_health_checkup as phc')
                ->join('health_packages as hp','hp.id','=','phc.package_id')
                ->where('phc.patient_id','=',session('patient_id'))
                ->select('phc.*','hp.package_name');
            $healthcheckups = $query->paginate(10);
        } catch(HospitalException $hospitalExc)
        {
            throw $hospitalExc;
        }
        catch(Exception $exc)
        {
            throw new HospitalException(null, ErrorEnum::HEALTH_CHECKUPS_LIST_ERROR, $exc);
        }
        return $healthcheckups;
    }

    public function getPatientSecondOpinion()
    {
        $secondOpinion = null;
        try {
            $secondOpinion=DB::table('patient_second_opinion as pso')
                ->join('doctor as d','d.doctor_id','=','pso.doctor_id')
                ->join('hospital as h','h.hospital_id','=','pso.hospital_id')
                ->join('patient_second_opinion_documents as psoi','psoi.patient_second_opinion_id','=','pso.id')
                ->where('pso.patient_id','=',session('patient_id'))
                ->select('d.name','d.specialty','pso.created_at as appointment_date','pso.detailed_description as brief_history','h.hospital_name','h.email','h.address as hsaddress','h.telephone','psoi.document_path as reports','pso.subject', 'pso.id')
                ->paginate(10);
        } catch(HospitalException $hospitalExc)
        {
            throw $hospitalExc;
        }
        catch(Exception $exc)
        {
            throw new HospitalException(null, ErrorEnum::SECOND_OPINION_LIST_ERROR, $exc);
        }
        return $secondOpinion;
    }

    public function getPatientHealthRecords()
    {
        $secondOpinion = null;
        try {
            $secondOpinion=DB::table('patient_old_document as doc')
                ->where('doc.patient_id','=',session('patient_id'))
                ->select('doc.*')
                ->paginate(10);
        } catch(HospitalException $hospitalExc)
        {
            throw $hospitalExc;
        }
        catch(Exception $exc)
        {
            throw new HospitalException(null, ErrorEnum::HEALTH_RECORDS_LIST_ERROR, $exc);
        }
        return $secondOpinion;
    }

    public function savePatientOldDocuments($request)
    {
        $date = date('Y-m-d');
        $status = 'true';
        $oldDocuments = null;
        $patient_id = session('patient_id');
        $path = '';
        try {
            if ($request->hasFile('oldDocument')) {
                $file= $request->file('oldDocument');
                $randomName = $this->generateUniqueFileName();
                //dd($randomName);
                $fileType= $file->getClientOriginalExtension();
                $OrgfileName=$file->getClientOriginalName();
                $filename=$patient_id.$randomName.'.'.$file->getClientOriginalExtension();
                $path=$path.$filename."@@";
                $destinationPath = 'public/olddocument'; // upload path
                $extension = $file->getClientOriginalExtension();
                //$fileName = rand(11111,99999).'.'.$extension; // renaming image
                $path = $filename;
                $file->move($destinationPath, $filename);

                $oldDocuments=new PatientOldDocuments();
                $oldDocuments->patient_id=$patient_id;
                $oldDocuments->document_path=$path;
                $oldDocuments->document_filename=$OrgfileName;
                $oldDocuments->document_extension=$fileType;
                $oldDocuments->document_upload_date=$date;
                $oldDocuments->document_upload_status="1";
                $oldDocuments->created_by = 'Admin';
                $oldDocuments->updated_by = 'Admin';
                $oldDocuments->save();
            }

        } catch(HospitalException $hospitalExc)
        {
            throw $hospitalExc;
        }
        catch(Exception $exc)
        {
            throw new HospitalException(null, ErrorEnum::HEALTH_RECORDS_LIST_ERROR, $exc);
        }
        return $status;
    }

}