<?php
/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/30/18
 * Time: 4:30 PM
 */

namespace App\patientportal\repositories\repositoryImpl;

use App\Http\ViewModels\PatientDentalViewModel;
use App\Http\ViewModels\PatientScanViewModel;
use App\Http\ViewModels\PatientUrineExaminationViewModel;
use App\Http\ViewModels\PatientXRayViewModel;
use App\Http\ViewModels\TestResultsViewModel;
use App\patientportal\modal\PatientUltrasoundExamination;
use App\patientportal\modal\PatientUltrasoundExaminationItems;
use App\patientportal\modal\BloodExamination;
use App\patientportal\modal\Doctor;
use App\patientportal\modal\DoctorAppointment;
use App\patientportal\modal\Hospital;
use App\patientportal\modal\LabFeeReceipt;
use App\patientportal\modal\LabLabtest;
use App\patientportal\modal\Labtest;
use App\patientportal\modal\MotionExamination;
use App\patientportal\modal\PatientBloodExamination;
use App\patientportal\modal\PatientBloodExaminationItems;
use App\patientportal\modal\PatientDentalExamination;
use App\patientportal\modal\PatientDentalExaminationItems;
use App\patientportal\modal\PatientLabtest;
use App\patientportal\modal\PatientMotionExamination;
use App\patientportal\modal\PatientMotionExaminationItems;
use App\patientportal\modal\PatientScanExamination;
use App\patientportal\modal\PatientScanExaminationItems;
use App\patientportal\modal\PatientUrineExamination;
use App\patientportal\modal\PatientUrineExaminationItems;
use App\patientportal\modal\PatientXRayExamination;
use App\patientportal\modal\PatientXRayExaminationItems;
use App\patientportal\modal\Scan;
use App\patientportal\modal\UltraSound;
use App\patientportal\modal\UrineExamination;
use App\User;
use App\patientportal\repositories\repoInterface\LabInterface;
use App\patientportal\utilities\AppointmentType;
use App\patientportal\utilities\ErrorEnum\ErrorEnum;
use App\patientportal\utilities\Helper;
//use App\prescription\model\entities\PatientUltrasoundExamination;
use Illuminate\Support\Facades\DB;
use Storage;
use Carbon\Carbon;
use Config as CA;
use Crypt;

use App\patientportal\utilities\Exception\UserNotFoundException;
use App\patientportal\utilities\Exception\LabException;
use App\patientportal\utilities\Exception\HospitalException;

/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/30/18
 * Time: 4:31 PM
 */
class LabImpl implements LabInterface
{

    public function getAppointment($request)
    {
        try {

            session(['methode' => $request->input('methode')]);
            $specialty = Doctor::select('specialty')->distinct()->get();
            //return $specialty;
            $hospitals = Hospital::select('hospital_id', 'hospital_name')->distinct()->get();
            // $hospitals = Hospital::all();

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }

        return view('diagnostics')->with('specialty', $specialty)->with('hospitals', $hospitals)->with('sessionmsg', '');


    }

    public function loadLabs($request)
    {
        $labs = null;
        try {

            $testid = $request->input("testid");

            //$hospitals= App\HospitalDoctor ::where('doctor_id','=',$doctor_id)->select('hospital_id')->get()->toArray();
            $query = LabLabtest::where('labtest_id', '=', $testid);
            $query->join('lab', 'lab.id', '=', 'lab_labtest.lab_id');
            $labs = $query->get();


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

    public function loadSubTests($request)
    {
        $subtests = null;
        try {

            $testtype = $request->input("testtype");

            //$hospitals= App\HospitalDoctor ::where('doctor_id','=',$doctor_id)->select('hospital_id')->get()->toArray();
            $subtests = Labtest::where('test_category', '=', $testtype)->get();


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


    private function setPatientLabTests($patientId, $hospitalId)
    {
        //$isExists = false;
        $count = PatientLabTest::where('patient_id', '=', $patientId)->where('hospital_id', '=', $hospitalId)->count();
        //dd($count);

        if ($count == 0) {
            $patientLabTest = new PatientLabtest();
            $patientLabTest->patient_id = $patientId;
            $patientLabTest->hospital_id = $hospitalId;
            $patientLabTest->created_by = 'Admin';
            $patientLabTest->modified_by = 'Admin';
            $patientLabTest->created_at = date("Y-m-d H:i:s");
            $patientLabTest->updated_at = date("Y-m-d H:i:s");

            $patientLabTest->save();
            //$isExists = true;
        }

        //return $isExists;
    }

    public function getPatientProfile($patientId)
    {
        $patientProfile = null;

        try {
            $query = DB::table('patient as p')->select('p.id', 'p.patient_id', 'p.name', 'p.pid', 'p.age',
                'p.gender', 'p.email', 'p.relationship', 'p.patient_spouse_name as spouseName', 'p.careof',
                'p.telephone', 'p.address', 'p.patient_photo', 'p.married', 'p.occupation', 'p.dob');
            $query->join('users as usr', 'usr.id', '=', 'p.patient_id');
            $query->where('p.patient_id', $patientId);
            $query->where('usr.delete_status', '=', 1);

            //dd($query->toSql());
            //, 'p.main_symptoms_id', 'p.sub_symptoms_id', 'p.symptoms_id'
            $patientProfile = $query->get();
            //dd($patientProfile);
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            throw new HospitalException(null, ErrorEnum::PATIENT_PROFILE_ERROR, $queryEx);
        } catch (Exception $exc) {
            throw new HospitalException(null, ErrorEnum::PATIENT_PROFILE_ERROR, $exc);
        }

        return $patientProfile;
    }


    public function getBloodTestsEntries()
    {
        $bloodTests = null;
        $hospitals = null;
        try {
            $bloodTests = BloodExamination::all();
            $hospitals = Hospital::all();

            $PatientBloodTests['bloodtests'] = $bloodTests;
            $PatientBloodTests['hospitals'] = $hospitals;

        } catch (QueryException $queryEx) {
            //dd($queryEx);
            throw new HospitalException(null, ErrorEnum::BLOODTEST_LIST_ERROR, $queryEx);
        } catch (Exception $exc) {
            throw new HospitalException(null, ErrorEnum::BLOODTEST_LIST_ERROR, $exc);
        }

        return $PatientBloodTests;
    }

    public function getMotionTestsEntries()
    {
        $hospitals = null;
        $MotionTests = null;
        try {


            $MotionTests = MotionExamination::all();
            $hospitals = Hospital::all();
            $patientMotionTests['motiontests'] = $MotionTests;
            $patientMotionTests['hospitals'] = $hospitals;

        } catch (QueryException $queryEx) {
            //dd($queryEx);
            throw new HospitalException(null, ErrorEnum::PATIENT_MOTION_DETAILS_ERROR, $queryEx);
        } catch (Exception $exc) {
            throw new HospitalException(null, ErrorEnum::PATIENT_MOTION_DETAILS_ERROR, $exc);
        }

        return $patientMotionTests;
    }

    public function getUrineTestsEntries()
    {

        $hospitals = null;
        $urineTests = null;
        try {
            //$patientUrineTests=$this->labService->getUrineTestsEntries();
            $urineTests = UrineExamination::all();
            $hospitals = Hospital::all();


            $patientUrineTests['urinetests'] = $urineTests;
            $patientUrineTests['hospitals'] = $hospitals;

        } catch (QueryException $queryEx) {
            //dd($queryEx);
            throw new HospitalException(null, ErrorEnum::URINETEST_LIST_ERROR, $queryEx);
        } catch (Exception $exc) {
            throw new HospitalException(null, ErrorEnum::URINETEST_LIST_ERROR, $exc);
        }

        return $patientUrineTests;
    }

    public function getScanTestsEntries()
    {
        $hospitals = null;
        $patientScans = null;
        try {

            $patientScans = Scan::where('status', '=', 1)->get();
            $hospitals = Hospital::all();

            $PatientScanTests['scantests'] = $patientScans;
            $PatientScanTests['hospitals'] = $hospitals;

        } catch (QueryException $queryEx) {
            //dd($queryEx);
            throw new HospitalException(null, ErrorEnum::SCAN_LIST_ERROR, $queryEx);
        } catch (Exception $exc) {
            throw new HospitalException(null, ErrorEnum::SCAN_LIST_ERROR, $exc);
        }

        return $PatientScanTests;

    }


    public function getUltrasoundTestsEntries()
    {
        $hospitals = null;
        $UltraSoundTests = null;
        try {

            // $patientUltraSoundTests=$this->labService->getUltrasoundTestsEntries();
            $UltraSoundTests = UltraSound::where('status', '=', 1)->get();
            $hospitals = Hospital::all();


            $patientUltraSoundTests['ultrasound'] = $UltraSoundTests;
            $patientUltraSoundTests['hospitals'] = $hospitals;

        } catch (QueryException $queryEx) {
            //dd($queryEx);
            throw new HospitalException(null, ErrorEnum::PATIENT_ULTRASOUND_DETAILS_ERROR, $queryEx);
        } catch
        (Exception $exc) {
            throw new HospitalException(null, ErrorEnum::PATIENT_ULTRASOUND_DETAILS_ERROR, $exc);
        }

        return $patientUltraSoundTests;
    }

    public function getDentalTestsEntries()
    {
        $hospitals = null;
        $dentalExaminations = null;
        $dentalExaminationCategory = null;

        try {
            // $dentalExaminations = HospitalServiceFacade::getAllDentalItems();

            //$dentalExaminations=$this->labService->getDentalTestsEntries();
            $query = DB::table('dental_examination_items as dei')->where('dei.examination_status', '=', 1);
            $query->join('dental_category as dc', 'dc.id', '=', 'dei.dental_category_id');
            $query->select('dei.id', 'dei.examination_name', 'dc.id as category_id', 'dc.category_name');


            $dentalExaminations = $query->get();

            $hospitals = Hospital::all();

            foreach ($dentalExaminations as $dentalExamination) {
               // dd($dentalExamination);
                $dentalExaminationCategory[$dentalExamination->category_id] = $dentalExamination->category_name;
                // dd($dentalExaminationCategory);
            }

            $PatientDentalTests['dentaltests'] = $dentalExaminations;
            $PatientDentalTests['$dentalExaminationCategory'] = $dentalExaminationCategory;
            $PatientDentalTests['hospitals'] = $hospitals;

        } catch (QueryException $queryEx) {
            //dd($queryEx);
            throw new HospitalException(null, ErrorEnum::DENTAL_LIST_ERROR, $queryEx);
        } catch
        (Exception $exc) {
            throw new HospitalException(null, ErrorEnum::DENTAL_LIST_ERROR, $exc);
        }

        return $PatientDentalTests;
    }


    public function getXrayTestsEntries()
    {
        $hospitals = null;
        $xrayExaminations = null;
        $xrayExaminationCategory = null;

        try {
           // $xrayExaminations = $this->labService->getXrayTestsEntries();


            $query = DB::table('xray_examination as xe')->where('xe.status', '=', 1);
            $query->select('xe.id', 'xe.examination_name', 'xe.category');

            $xrayExaminations = $query->get();

            $hospitals = Hospital::all();
            foreach ($xrayExaminations as $xrayExamination) {
                $xrayExaminationCategory[$xrayExamination->category] = $xrayExamination->examination_name;
            }


            $PatientXrayTests['bloodtests'] = $xrayExaminations;
            $PatientXrayTests['xrayExaminationCategory'] = $xrayExaminationCategory;
            $PatientXrayTests['hospitals'] = $hospitals;

        } catch (QueryException $queryEx) {
            //dd($queryEx);
            throw new HospitalException(null, ErrorEnum::XRAY_LIST_ERROR, $queryEx);
        } catch (Exception $exc) {
            throw new HospitalException(null, ErrorEnum::XRAY_LIST_ERROR, $exc);
        }

        return $PatientXrayTests;
    }


    public function saveMotionTestResults(TestResultsViewModel $testResultsVM)
    {
        $status = true;

        try {
            $patientId = $testResultsVM->getPatientId();
            //dd($patientId);
            //$patientUser = User::find($patientId);

            $motionResults = $testResultsVM->getTestResults();
            //dd($bloodResults);

            $patient = Helper::checkPatientExists($patientId);

            if (!is_null($patient)) {
                //dd('Inside patient');
                foreach ($motionResults as $motionResult) {
                    $examinationId = $motionResult->examinationId;
                    $examinationValue = $motionResult->examinationValue;
                    //dd($examinationId);

                    $patientMotionExaminationItems = PatientMotionExaminationItems::find($examinationId);
                    //dd($patientBloodExamination);
                    $patientMotionExaminationItems->test_readings = $examinationValue;
                    $patientMotionExaminationItems->test_reading_status = 1;
                    $patientMotionExaminationItems->modified_by = $testResultsVM->getUpdatedBy();
                    $patientMotionExaminationItems->updated_at = $testResultsVM->getUpdatedAt();

                    $patientMotionExaminationItems->save();
                }
            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            $status = false;
            throw new LabException(null, ErrorEnum::PATIENT_TEST_RESULTS_ERROR, $queryEx);
        } catch (Exception $exc) {
            $status = false;
            throw new LabException(null, ErrorEnum::PATIENT_TEST_RESULTS_ERROR, $exc);
        }

        return $status;
    }


    /**
     * Save urine test results
     * @param $testResultsVM
     * @throws $labException
     * @return true | false
     * @author Baskar
     */

    public function saveUrineTestResults(TestResultsViewModel $testResultsVM)
    {
        $status = true;

        try {
            $patientId = $testResultsVM->getPatientId();
            //dd($patientId);
            //$patientUser = User::find($patientId);

            $urineResults = $testResultsVM->getTestResults();
            //dd($bloodResults);

            $patient = Helper::checkPatientExists($patientId);

            if (!is_null($patient)) {
                //dd('Inside patient');
                foreach ($urineResults as $urineResult) {
                    $examinationId = $urineResult->examinationId;
                    $examinationValue = $urineResult->examinationValue;
                    //dd($examinationId);

                    $patientUrineExaminationItems = PatientUrineExaminationItems::find($examinationId);
                    //dd($patientBloodExamination);
                    $patientUrineExaminationItems->test_readings = $examinationValue;
                    $patientUrineExaminationItems->test_reading_status = 1;
                    $patientUrineExaminationItems->modified_by = $testResultsVM->getUpdatedBy();
                    $patientUrineExaminationItems->updated_at = $testResultsVM->getUpdatedAt();

                    $patientUrineExaminationItems->save();
                }
            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            $status = false;
            throw new LabException(null, ErrorEnum::PATIENT_TEST_RESULTS_ERROR, $queryEx);
        } catch (Exception $exc) {
            $status = false;
            throw new LabException(null, ErrorEnum::PATIENT_TEST_RESULTS_ERROR, $exc);
        }

        return $status;
    }

    /**
     * Save ultrasound test results
     * @param $testResultsVM
     * @throws $labException
     * @return true | false
     * @author Baskar
     */

    public function saveUltrasoundTestResults(TestResultsViewModel $testResultsVM)
    {
        $status = true;

        try {
            $patientId = $testResultsVM->getPatientId();
            //dd($patientId);
            //$patientUser = User::find($patientId);

            $ultrasoundResults = $testResultsVM->getTestResults();
            //dd($bloodResults);

            $patient = Helper::checkPatientExists($patientId);

            if (!is_null($patient)) {
                //dd('Inside patient');
                foreach ($ultrasoundResults as $ultrasoundResult) {
                    $examinationId = $ultrasoundResult->examinationId;
                    $examinationValue = $ultrasoundResult->examinationValue;
                    //dd($examinationId);

                    $patientUltrasoundExamination = PatientUltrasoundExamination::find($examinationId);
                    //dd($patientBloodExamination);
                    $patientUltrasoundExamination->test_readings = $examinationValue;
                    $patientUltrasoundExamination->test_reading_status = 1;
                    $patientUltrasoundExamination->modified_by = $testResultsVM->getUpdatedBy();
                    $patientUltrasoundExamination->updated_at = $testResultsVM->getUpdatedAt();

                    $patientUltrasoundExamination->save();
                }
            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            $status = false;
            throw new LabException(null, ErrorEnum::PATIENT_TEST_RESULTS_ERROR, $queryEx);
        } catch (Exception $exc) {
            $status = false;
            throw new LabException(null, ErrorEnum::PATIENT_TEST_RESULTS_ERROR, $exc);
        }

        return $status;
    }

    /**
     * Save scan test results
     * @param $testResultsVM
     * @throws $labException
     * @return true | false
     * @author Baskar
     */

    public function saveScanTestResults(TestResultsViewModel $testResultsVM)
    {
        $status = true;

        try {
            $patientId = $testResultsVM->getPatientId();
            //dd($patientId);
            //$patientUser = User::find($patientId);

            $scanResults = $testResultsVM->getTestResults();
            //dd($bloodResults);

            $patient = Helper::checkPatientExists($patientId);

            if (!is_null($patient)) {
                //dd('Inside patient');
                foreach ($scanResults as $scanResult) {
                    $examinationId = $scanResult->examinationId;
                    $examinationValue = $scanResult->examinationValue;
                    //dd($examinationId);

                    $patientScanExamination = PatientScanExamination::find($examinationId);
                    //dd($patientBloodExamination);
                    $patientScanExamination->test_readings = $examinationValue;
                    $patientScanExamination->test_reading_status = 1;
                    $patientScanExamination->modified_by = $testResultsVM->getUpdatedBy();
                    $patientScanExamination->updated_at = $testResultsVM->getUpdatedAt();

                    $patientScanExamination->save();
                }
            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            $status = false;
            throw new LabException(null, ErrorEnum::PATIENT_TEST_RESULTS_ERROR, $queryEx);
        } catch (Exception $exc) {
            $status = false;
            throw new LabException(null, ErrorEnum::PATIENT_TEST_RESULTS_ERROR, $exc);
        }

        return $status;
    }

    public function loaddoctorLab($request)
    {


        $doctors = null;
        try {

            $hosID = $request->input("hospital_id");

            //$hospitals= App\HospitalDoctor ::where('doctor_id','=',$doctor_id)->select('hospital_id')->get()->toArray();
            $query = DB::table('hospital_doctor as hp')->where('hp.hospital_id', '=', $hosID);
            $query->join('doctor as d', 'd.doctor_id', '=', 'hp.doctor_id');
            $query->select('d.doctor_id', 'd.name');
            $doctors = $query->get();
//dd($doctors);
            //  $doctors=Doctor::where('doctor_id','=',$doctors[0]['doctor_id']);


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

    function savePatientBloodTestsTESTVERSION(PatientUrineExaminationViewModel $patientBloodVM)
    {
        $status = true;
        $hospitalLabId = null;

        try {
            $patientId = $patientBloodVM->getPatientId();
            $doctorId = $patientBloodVM->getDoctorId();
            $hospitalId = $patientBloodVM->getHospitalId();
            $labId = $patientBloodVM->getLabId();

            // $patientUser = User::find($patientId);
            //   dd($patientId);
            $patientExaminations = $patientBloodVM->getExaminations();

            $patient = Helper::checkPatientExists($patientId);
            // dd($patient);
            if (!is_null($patient)) {
                //DB::table('patient_family_illness')->where('patient_id', $patientId)->delete();
                //$patientUser = User::find($patientId);
                $patientUser = User::find($patientId);

                //  dd($patientUser);
                foreach ($patientExaminations as $examination) {
                    //dd($patientHistory);
                    $examinationId = $examination->examinationId;
                    $isValueSet = $examination->isValueSet;
                    //$pregnancyDate = $pregnancy->pregnancyDate;

                    $examinationDate = property_exists($examination, 'examinationDate') ? $examination->examinationDate : null;
                    $examinationTime = (isset($examination->examinationTime)) ? $examination->examinationTime : null;

                    if (!is_null($examinationDate)) {
                        $patientExaminationDate = date('Y-m-d', strtotime($examinationDate));
                    } else {
                        $patientExaminationDate = null;
                    }

                    //  dd($patientUser);
                    $patientUser->patientbloodexaminations()->attach($examinationId,
                        array('examination_date' => $patientExaminationDate,
                            'examination_time' => $examinationTime,
                            'is_value_set' => $isValueSet,
                            'doctor_id' => $doctorId,
                            'hospital_id' => $hospitalId,
                            'created_by' => 'Admin',
                            'modified_by' => 'Admin',
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s"),
                        ));

                }

            } else {
                throw new UserNotFoundException();
            }
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
            throw new HospitalException();
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException();
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
            throw new HospitalException();
        }

        return $status;
    }

    private function generateTokenId($hospitalId, $doctorId, $appointmentDate)
    {
        //$defaultTokenId = trans('constants.token_id');
        $defaultTokenId = 1;
//dd($defaultTokenId);
        //$maxVal = 0;

        /*$maxId = DB::table('doctor_appointment')->max('token_id');*/

        // dd('test');
        $maxId = DoctorAppointment::where('hospital_id', '=', $hospitalId)
            ->where('doctor_id', '=', $doctorId)
            ->where('appointment_date', '=', $appointmentDate)->max('token_id');


        if ($maxId == 0 || $maxId == "") {
            //$maxVal = intval($defaultValue);
            //  dd($defaultTokenId);
            $maxVal = $defaultTokenId;
        } else {
            $maxVal = $maxId + 1;
            //  dd($maxVal);
        }

        return $maxVal;
    }

    public function savePatientBloodTestsNew(PatientUrineExaminationViewModel $patientBloodVM)
    {
        $status = true;
        //$hospitalLabId = null;

        try {
            $patientId = $patientBloodVM->getPatientId();
            $doctorId = $patientBloodVM->getDoctorId();
            $hospitalId = $patientBloodVM->getHospitalId();
            //$labId = $patientBloodVM->getLabId();
            //$patientUser = User::find($patientId);

            $bloodExaminations = $patientBloodVM->getExaminations();
            $examinationDate = $patientBloodVM->getExaminationDate();
            $examinationTime = $patientBloodVM->getExaminationTime();

            $bloodExamCategory = CA::get('constants.BLOOD_EXAMINATION_CATEGORY');


            $patient = Helper::checkPatientExists($patientId);

            $date = date('Y-m-d');
            $doctorappment = DB::table('doctor_appointment')->where('patient_id', '=', $patient[0])->where('appointment_date', '=', $date)->select('patient_id')->get();


            if (is_null($doctorappment)) {
                //$appointments = $patientProfileVM->getAppointment();
                $appointmentStatus = AppointmentType::APPOINTMENT_OPEN;
                $doctorAppointment = new DoctorAppointment();

                $doctorAppointment->patient_id = $patientId;
                $doctorAppointment->doctor_id = $doctorId;
                $doctorAppointment->hospital_id = $hospitalId;
                $doctorAppointment->brief_history = "BloodTest";
                $doctorAppointment->appointment_date = date('Y-m-d');
                $doctorAppointment->appointment_time =
                $doctorAppointment->appointment_category = $examinationTime;
                $doctorAppointment->appointment_status_id = $appointmentStatus;
                //BY PRASANTH 24-01-2018 START//
                //we are adding+1 for existing count value for display current TokenID
                // $patientTokenId=intval($patientTokenId)+1;


                $patientTokenId = $this->generateTokenId($hospitalId, $doctorId, $examinationDate);
                //$patientTokenId=intval($patientTokenId)+1;
                $doctorAppointment->token_id = $patientTokenId;
                //BY PRASANTH 24-01-2018 END//
                $doctorAppointment->referral_type = "";
                $doctorAppointment->referral_doctor = "";
                $doctorAppointment->referral_hospital = "";
                $doctorAppointment->referral_hospital_location = "";
                $doctorAppointment->fee = 200;
                $doctorAppointment->payment_type = "card";
                $doctorAppointment->created_by = "Admin";
                $doctorAppointment->modified_by = "Admin";
                $doctorAppointment->created_at = date("Y-m-d H:i:s");
                $doctorAppointment->updated_at = date("Y-m-d H:i:s");

                $doctorUser = $doctorAppointment->save();

            }
            if (!is_null($patient)) {
                //$patientUser = User::find($patientId);
                //DB::table('patient_family_illness')->where('patient_id', $patientId)->delete();
                //dd($patientDentalVM->getExaminationDate());
                //$examinationDt = property_exists($patientBloodVM, 'examinationDate') ? $examinationDate : null;
                //dd($examinationDt);

                if (!is_null($examinationDate)) {
                    $patientExaminationDate = date('Y-m-d', strtotime($examinationDate));
                } else {
                    $patientExaminationDate = null;
                }

                /*if(is_null($labId))
                {
                    $hospitalLabId = $this->getLabIdForHospital($hospitalId);
                }*/

                //dd($patientExaminationDate);

                $bloodExamination = new PatientBloodExamination();
                $bloodExamination->patient_id = $patientId;
                $bloodExamination->hospital_id = $hospitalId;
                $bloodExamination->doctor_id = $doctorId;
                //$bloodExamination->lab_id = $hospitalLabId;
                $bloodExamination->examination_date = $patientExaminationDate;
                $bloodExamination->examination_time = $examinationTime;
                $bloodExamination->created_by = $patientBloodVM->getCreatedBy();
                $bloodExamination->modified_by = $patientBloodVM->getUpdatedBy();
                $bloodExamination->created_at = $patientBloodVM->getCreatedAt();
                $bloodExamination->updated_at = $patientBloodVM->getUpdatedAt();
                //$patientBloodExamination = $bloodExamination->save();
                $bloodExamination->save();

                foreach ($bloodExaminations as $examination) {
                    $examinationId = $examination->examinationId;
                    $isValueSet = $examination->isValueSet;

                    if (in_array($examinationId, $bloodExamCategory)) {
                        $categoryQuery = DB::table('blood_examination as be')->where('be.parent_id', '=', $examinationId);
                        $categoryQuery->where('be.has_child', '!=', 1);
                        $categoryQuery->where('be.status', '=', 1);
                        $categoryQuery->select('id');
                        $categoryItems = $categoryQuery->get();

                        foreach ($categoryItems as $item) {
                            // dd($item);
                            $bloodExaminationItems = new PatientBloodExaminationItems();

                            $bloodExaminationItems->blood_examination_id = $item['id'];
                            $bloodExaminationItems->is_value_set = $isValueSet;
                            $bloodExaminationItems->created_by = $patientBloodVM->getCreatedBy();
                            $bloodExaminationItems->modified_by = $patientBloodVM->getUpdatedBy();
                            $bloodExaminationItems->created_at = $patientBloodVM->getCreatedAt();
                            $bloodExaminationItems->updated_at = $patientBloodVM->getUpdatedAt();

                            $bloodExamination->bloodexaminationitems()->save($bloodExaminationItems);
                        }
                        /*if($isValueSet == 1)
                        {

                        }*/


                    } else {
                        $bloodExaminationItems = new PatientBloodExaminationItems();

                        $bloodExaminationItems->blood_examination_id = $examination->examinationId;
                        $bloodExaminationItems->is_value_set = $examination->isValueSet;
                        $bloodExaminationItems->created_by = $patientBloodVM->getCreatedBy();
                        $bloodExaminationItems->modified_by = $patientBloodVM->getUpdatedBy();
                        $bloodExaminationItems->created_at = $patientBloodVM->getCreatedAt();
                        $bloodExaminationItems->updated_at = $patientBloodVM->getUpdatedAt();

                        $bloodExamination->bloodexaminationitems()->save($bloodExaminationItems);
                    }

                }

                $this->setPatientLabTests($patientId, $hospitalId);

            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            dd($queryEx);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_BLOOD_DETAILS_SAVE_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            dd($exc);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_BLOOD_DETAILS_SAVE_ERROR, $exc);
        }

        return $status;
    }




    public function savePatientBloodTestsNew1(PatientUrineExaminationViewModel $patientBloodVM)
    {
        $status = true;
        //$hospitalLabId = null;
       // dd($patientBloodVM);

        try {
            $patientId = $patientBloodVM->getPatientId();
            $doctorId = $patientBloodVM->getDoctorId();
            //dd($doctorId);
            $hospitalId = $patientBloodVM->getHospitalId();
            //$labId = $patientBloodVM->getLabId();
            //$patientUser = User::find($patientId);

            $bloodExaminations = $patientBloodVM->getExaminations();
            $examinationDate = $patientBloodVM->getExaminationDate();
            $examinationTime = $patientBloodVM->getExaminationTime();

            $bloodExamCategory = CA::get('constants.BLOOD_EXAMINATION_CATEGORY');


            //dd($examinationDate);

            /*$doctor = Helper::checkDoctorExists($doctorId);

            if(is_null($doctor))
            {
                throw new UserNotFoundException(null, ErrorEnum::USER_NOT_FOUND, null);
            }

            $hospital = Helper::checkHospitalExists($hospitalId);

            if(is_null($hospital))
            {
                throw new UserNotFoundException(null, ErrorEnum::HOSPITAL_USER_NOT_FOUND, null);
            }*/

            $patient = Helper::checkPatientExists($patientId);

            if (!is_null($patient)) {
                //$patientUser = User::find($patientId);
                //DB::table('patient_family_illness')->where('patient_id', $patientId)->delete();
                //dd($patientDentalVM->getExaminationDate());
                //dd('Test');
                //$examinationDt = property_exists($patientBloodVM, 'examinationDate') ? $examinationDate : null;
                //dd('After Test');
                //dd($examinationDt);

                if (!is_null($examinationDate)) {
                    $patientExaminationDate = date('Y-m-d', strtotime($examinationDate));
                } else {
                    $patientExaminationDate = null;
                }

                /*if(is_null($labId))
                {
                    $hospitalLabId = $this->getLabIdForHospital($hospitalId);
                }*/

                //dd($patientExaminationDate);

                $bloodExamination = new PatientBloodExamination();
                $bloodExamination->patient_id = $patientId;
                $bloodExamination->hospital_id = $hospitalId;
                $bloodExamination->doctor_id = $doctorId;
                //$bloodExamination->lab_id = $hospitalLabId;
                $bloodExamination->examination_date = $patientExaminationDate;
                $bloodExamination->examination_time = $examinationTime;
                $bloodExamination->created_by = $patientBloodVM->getCreatedBy();
                $bloodExamination->modified_by = $patientBloodVM->getUpdatedBy();
                $bloodExamination->created_at = $patientBloodVM->getCreatedAt();
                $bloodExamination->updated_at = $patientBloodVM->getUpdatedAt();
                //$patientBloodExamination = $bloodExamination->save();
                $bloodExamination->save();

                foreach ($bloodExaminations as $examination) {

                  // dd($bloodExamCategory);
                    $examinationId = $examination->examinationId;
                    $isValueSet = $examination->isValueSet;

                    if (in_array($examinationId, $bloodExamCategory)) {

                        //dd($examinationId);
                        $categoryQuery = DB::table('blood_examination as be')->where('be.parent_id', '=', $examinationId);
                        $categoryQuery->where('be.has_child', '!=', 1);
                        $categoryQuery->where('be.status', '=', 1);
                        $categoryQuery->select('id');

                        //dd($categoryQuery->toSql());

                        $categoryItems = $categoryQuery->get();
                       // dd($categoryItems);

                        foreach ($categoryItems as $item) {
                          //  dd($item);
                            $bloodExaminationItems = new PatientBloodExaminationItems();
//dd($examination);
                            $bloodExaminationItems->blood_examination_id = $item->id;
                            $bloodExaminationItems->is_value_set = $examination->isValueSet;
                            $bloodExaminationItems->created_by = $patientBloodVM->getCreatedBy();
                            $bloodExaminationItems->modified_by = $patientBloodVM->getUpdatedBy();
                            $bloodExaminationItems->created_at = $patientBloodVM->getCreatedAt();
                            $bloodExaminationItems->updated_at = $patientBloodVM->getUpdatedAt();

                            $bloodExamination->bloodexaminationitems()->save($bloodExaminationItems);
                        }
                        /*if($isValueSet == 1)
                        {

                        }*/


                    } else {
                        $bloodExaminationItems = new PatientBloodExaminationItems();

                        $bloodExaminationItems->blood_examination_id = $examination->examinationId;
                        $bloodExaminationItems->is_value_set = $examination->isValueSet;
                        $bloodExaminationItems->created_by = $patientBloodVM->getCreatedBy();
                        $bloodExaminationItems->modified_by = $patientBloodVM->getUpdatedBy();
                        $bloodExaminationItems->created_at = $patientBloodVM->getCreatedAt();
                        $bloodExaminationItems->updated_at = $patientBloodVM->getUpdatedAt();

                        $bloodExamination->bloodexaminationitems()->save($bloodExaminationItems);
                    }

                    /*$patientBloodExamFees = new PatientBloodExaminationFees();
                    $patientBloodExamFees->blood_examination_id = $examinationId;
                    $patientBloodExamFees->created_by = $patientBloodVM->getCreatedBy();
                    $patientBloodExamFees->modified_by = $patientBloodVM->getUpdatedBy();
                    $patientBloodExamFees->created_at = $patientBloodVM->getCreatedAt();
                    $patientBloodExamFees->updated_at = $patientBloodVM->getUpdatedAt();
                    $bloodExamination->bloodexaminationfees()->save($patientBloodExamFees);*/


                }

                $this->setPatientLabTests($patientId, $hospitalId);

            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_BLOOD_DETAILS_SAVE_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_BLOOD_DETAILS_SAVE_ERROR, $exc);
        }

        return $status;
    }

    private function savePatientBloodTestsFees(PatientUrineExaminationViewModel $patientBloodVM, $bloodExamination, $examination)
    {
        $patientBloodExamFees = new PatientBloodExaminationFees();
        //$patientBloodExamFees->


    }

    public function savePatientXRayTests(PatientXRayViewModel $patientXRayVM)
    {
        $status = true;
        $patientExaminationDate = null;

        try {
            $patientId = $patientXRayVM->getPatientId();
            $doctorId = $patientXRayVM->getDoctorId();
            $hospitalId = $patientXRayVM->getHospitalId();
            //$labId = $patientXRayVM->getLabId();
            $xrayExaminations = $patientXRayVM->getPatientXRayTests();
            $examinationDate = $patientXRayVM->getExaminationDate();
            $examinationTime = $patientXRayVM->getExaminationTime();
            $patient = Helper::checkPatientExists($patientId);

            $date = date('Y-m-d');
            $doctorappment = DB::table('doctor_appointment')->where('patient_id', '=', $patient[0])->where('appointment_date', '=', $date)->select('patient_id')->get();

            if (is_null($doctorappment)) {
                //$appointments = $patientProfileVM->getAppointment();
                $appointmentStatus = AppointmentType::APPOINTMENT_OPEN;
                $doctorAppointment = new DoctorAppointment();
                $doctorAppointment->patient_id = $patientId;
                $doctorAppointment->doctor_id = $doctorId;
                $doctorAppointment->hospital_id = $hospitalId;
                $doctorAppointment->brief_history = "BloodTest";
                $doctorAppointment->appointment_date = date('Y-m-d');
                $doctorAppointment->appointment_time =
                $doctorAppointment->appointment_category = $examinationTime;
                $doctorAppointment->appointment_status_id = $appointmentStatus;
                //BY PRASANTH 24-01-2018 START//
                //we are adding+1 for existing count value for display current TokenID
                // $patientTokenId=intval($patientTokenId)+1;


                $patientTokenId = $this->generateTokenId($hospitalId, $doctorId, $examinationDate);
                //$patientTokenId=intval($patientTokenId)+1;
                $doctorAppointment->token_id = $patientTokenId;
                //BY PRASANTH 24-01-2018 END//
                $doctorAppointment->referral_type = "";
                $doctorAppointment->referral_doctor = "";
                $doctorAppointment->referral_hospital = "";
                $doctorAppointment->referral_hospital_location = "";
                $doctorAppointment->fee = 200;
                $doctorAppointment->payment_type = "card";
                $doctorAppointment->created_by = "Admin";
                $doctorAppointment->modified_by = "Admin";
                $doctorAppointment->created_at = date("Y-m-d H:i:s");
                $doctorAppointment->updated_at = date("Y-m-d H:i:s");
                $doctorUser = $doctorAppointment->save();
            }

            if (!is_null($patient)) {
                //DB::table('patient_family_illness')->where('patient_id', $patientId)->delete();
                $examinationDt = property_exists($patientXRayVM->getExaminationDate(), 'examinationDate') ? $examinationDate : null;
                if (!is_null($examinationDate)) {
                    $patientExaminationDate = date('Y-m-d', strtotime($examinationDate));
                } else {
                    $patientExaminationDate = null;
                }

                $xrayExamination = new PatientXRayExamination();
                $xrayExamination->patient_id = $patientId;
                $xrayExamination->hospital_id = $hospitalId;
                $xrayExamination->doctor_id = $patientXRayVM->getDoctorId();
                //$xrayExamination->lab_id = $hospitalLabId;
                $xrayExamination->examination_date = $patientExaminationDate;
                $xrayExamination->examination_time = $examinationTime;
                $xrayExamination->created_by = $patientXRayVM->getCreatedBy();
                $xrayExamination->modified_by = $patientXRayVM->getUpdatedBy();
                $xrayExamination->created_at = $patientXRayVM->getCreatedAt();
                $xrayExamination->updated_at = $patientXRayVM->getUpdatedAt();
                $xrayExamination->save();

                foreach ($xrayExaminations as $examination) {
                    $xrayExaminationItems = new PatientXRayExaminationItems();
                    $xrayExaminationItems->xray_examination_item_id = $examination->xrayExaminationId;
                    //$examinationDate = property_exists($patientDentalVM->getExaminationDate(), 'examinationDate') ? $examinationDate : null;
                    //$xrayExaminationItems->xray_examination_name = property_exists($examination->xrayExaminationName, 'xrayExaminationName') ? $examination->xrayExaminationName : null;
                    $xrayExaminationItems->xray_examination_name = (isset($examination->xrayExaminationName)) ? $examination->xrayExaminationName : null;
                    //$dentalExaminationItems->dental_examination_name = $examination->dentalExaminationName;
                    $xrayExaminationItems->created_by = $patientXRayVM->getCreatedBy();
                    $xrayExaminationItems->modified_by = $patientXRayVM->getUpdatedBy();
                    $xrayExaminationItems->created_at = $patientXRayVM->getCreatedAt();
                    $xrayExaminationItems->updated_at = $patientXRayVM->getUpdatedAt();
                    if (!is_null($xrayExaminationItems->xray_examination_name)) {
                        $xrayExamination->xrayexaminationitems()->save($xrayExaminationItems);
                    }
                }

                $this->setPatientLabTests($patientId, $hospitalId);

            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_XRAY_TESTS_SAVE_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_XRAY_TESTS_SAVE_ERROR, $exc);
        }

        return $status;
    }

    public function savePatientUltraSoundTests(PatientUrineExaminationViewModel $patientUltraSoundVM)
    {
        $status = true;


        try {
            //dd('test');
            $patientId = $patientUltraSoundVM->getPatientId();
            $doctorId = $patientUltraSoundVM->getDoctorId();
            //dd($doctorId);
            $hospitalId = $patientUltraSoundVM->getHospitalId();
            //$patientUser = User::find($patientId);

            $patientExaminations = $patientUltraSoundVM->getExaminations();
            $examinationDate = $patientUltraSoundVM->getExaminationDate();
            $examinationTime = $patientUltraSoundVM->getExaminationTime();


            /*$doctor = Helper::checkDoctorExists($doctorId);

            if(is_null($doctor))
            {
                throw new UserNotFoundException(null, ErrorEnum::USER_NOT_FOUND, null);
            }

            $hospital = Helper::checkHospitalExists($hospitalId);

            if(is_null($hospital))
            {
                throw new UserNotFoundException(null, ErrorEnum::HOSPITAL_USER_NOT_FOUND, null);
            }*/

            $patient = Helper::checkPatientExists($patientId);
            $date = date('Y-m-d');
            $doctorappment = DB::table('doctor_appointment')->where('patient_id', '=', $patient[0])->where('appointment_date', '=', $date)->select('patient_id')->get();


            if (is_null($doctorappment)) {
                //$appointments = $patientProfileVM->getAppointment();
                $appointmentStatus = AppointmentType::APPOINTMENT_OPEN;
                $doctorAppointment = new DoctorAppointment();

                $doctorAppointment->patient_id = $patientId;
                $doctorAppointment->doctor_id = $doctorId;
                $doctorAppointment->hospital_id = $hospitalId;
                $doctorAppointment->brief_history = "BloodTest";
                $doctorAppointment->appointment_date = date('Y-m-d');
                $doctorAppointment->appointment_time =
                $doctorAppointment->appointment_category = $examinationTime;
                $doctorAppointment->appointment_status_id = $appointmentStatus;
                //BY PRASANTH 24-01-2018 START//
                //we are adding+1 for existing count value for display current TokenID
                // $patientTokenId=intval($patientTokenId)+1;


                $patientTokenId = $this->generateTokenId($hospitalId, $doctorId, $examinationDate);
                //dd($patientTokenId);
                //$patientTokenId=intval($patientTokenId)+1;
                $doctorAppointment->token_id = $patientTokenId;
                //BY PRASANTH 24-01-2018 END//
                $doctorAppointment->referral_type = "";
                $doctorAppointment->referral_doctor = "";
                $doctorAppointment->referral_hospital = "";
                $doctorAppointment->referral_hospital_location = "";
                $doctorAppointment->fee = 200;
                $doctorAppointment->payment_type = "card";
                $doctorAppointment->created_by = "Admin";
                $doctorAppointment->modified_by = "Admin";
                $doctorAppointment->created_at = date("Y-m-d H:i:s");
                $doctorAppointment->updated_at = date("Y-m-d H:i:s");

                $doctorUser = $doctorAppointment->save();

            }
            if (!is_null($patient)) {
                //DB::table('patient_family_illness')->where('patient_id', $patientId)->delete();
                $patientUser = User::find($patientId);

                foreach ($patientExaminations as $examination) {
                    //dd($patientHistory);
                    $examinationId = $examination->examinationId;
                    $isValueSet = $examination->isValueSet;
                    $examinationTime = (isset($examination->examinationTime)) ? $examination->examinationTime : null;
                    //$pregnancyDate = $pregnancy->pregnancyDate;

                    $examinationDate = property_exists($examination, 'examinationDate') ? $examination->examinationDate : null;

                    if (!is_null($examinationDate)) {
                        $patientExaminationDate = date('Y-m-d', strtotime($examinationDate));
                    } else {
                        $patientExaminationDate = null;
                    }

                    $patientUser->patientultrasounds()->attach($examinationId,
                        array('examination_date' => $patientExaminationDate,
                            'examination_time' => $examinationTime,
                            'is_value_set' => $isValueSet,
                            'doctor_id' => $doctorId,
                            'hospital_id' => $hospitalId,
                            'created_by' => 'Admin',
                            'modified_by' => 'Admin',
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s"),
                        ));

                }

            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_ULTRASOUND_DETAILS_SAVE_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_ULTRASOUND_DETAILS_SAVE_ERROR, $exc);
        }

        return $status;
    }

    public function savePatientUltraSoundTestsNew(PatientUrineExaminationViewModel $patientUltraSoundVM)
    {
        $status = true;
        try {
            $patientId = $patientUltraSoundVM->getPatientId();
            $doctorId = $patientUltraSoundVM->getDoctorId();
            $hospitalId = $patientUltraSoundVM->getHospitalId();

            $ultrasoundExaminations = $patientUltraSoundVM->getExaminations();
            //dd($ultrasoundExaminations);
            $examinationDate = $patientUltraSoundVM->getExaminationDate();
            $examinationTime = $patientUltraSoundVM->getExaminationTime();
            $patient = Helper::checkPatientExists($patientId);
            $date = date('Y-m-d');
            $doctorappment = DB::table('doctor_appointment')->where('patient_id', '=', $patient[0])->where('appointment_date', '=', $date)->select('patient_id')->get();

            if (is_null($doctorappment)) {
                //$appointments = $patientProfileVM->getAppointment();
                $appointmentStatus = AppointmentType::APPOINTMENT_OPEN;
                dd($appointmentStatus);
                $doctorAppointment = new DoctorAppointment();

                $doctorAppointment->patient_id = $patientId;
                $doctorAppointment->doctor_id = $doctorId;
                $doctorAppointment->hospital_id = $hospitalId;
                $doctorAppointment->brief_history = "BloodTest";
                $doctorAppointment->appointment_date = date('Y-m-d');
                $doctorAppointment->appointment_time =
                $doctorAppointment->appointment_category = $examinationTime;
                $doctorAppointment->appointment_status_id = $appointmentStatus;
                dd($examinationDate);
                $patientTokenId = $this->generateTokenId($hospitalId, $doctorId, $examinationDate);
                dd($patientTokenId);
                $doctorAppointment->token_id = $patientTokenId;
                $doctorAppointment->referral_type = "";
                $doctorAppointment->referral_doctor = "";
                $doctorAppointment->referral_hospital = "";
                $doctorAppointment->referral_hospital_location = "";
                $doctorAppointment->fee = 200;
                $doctorAppointment->payment_type = "card";
                $doctorAppointment->created_by = "Admin";
                $doctorAppointment->modified_by = "Admin";
                $doctorAppointment->created_at = date("Y-m-d H:i:s");
                $doctorAppointment->updated_at = date("Y-m-d H:i:s");

                $doctorUser = $doctorAppointment->save();

            }

            if (!is_null($patient)) {
                if (!is_null($examinationDate)) {
                    $patientExaminationDate = date('Y-m-d', strtotime($examinationDate));
                } else {
                    $patientExaminationDate = null;
                }

                $ultrasoundExamination = new PatientUltrasoundExamination();
                $ultrasoundExamination->patient_id = $patientId;
                $ultrasoundExamination->hospital_id = $hospitalId;
                $ultrasoundExamination->doctor_id = $doctorId;
                $ultrasoundExamination->examination_date = $patientExaminationDate;
                $ultrasoundExamination->examination_time = $examinationTime;
                $ultrasoundExamination->created_by = $patientUltraSoundVM->getCreatedBy();
                $ultrasoundExamination->modified_by = $patientUltraSoundVM->getUpdatedBy();
                $ultrasoundExamination->created_at = $patientUltraSoundVM->getCreatedAt();
                $ultrasoundExamination->updated_at = $patientUltraSoundVM->getUpdatedAt();
                $ultrasoundExamination->save();
                //dd($ultrasoundExamination);

                foreach ($ultrasoundExaminations as $examination) {
                    $ultrasoundExaminationItems = new PatientUltrasoundExaminationItems();
                    $ultrasoundExaminationItems->ultra_sound_id = $examination->examinationId;
                    $ultrasoundExaminationItems->is_value_set = $examination->isValueSet;
                    $ultrasoundExaminationItems->created_by = $patientUltraSoundVM->getCreatedBy();
                    $ultrasoundExaminationItems->modified_by = $patientUltraSoundVM->getUpdatedBy();
                    $ultrasoundExaminationItems->created_at = $patientUltraSoundVM->getCreatedAt();
                    $ultrasoundExaminationItems->updated_at = $patientUltraSoundVM->getUpdatedAt();

                    $ultrasoundExamination->ultrasoundexaminationitems()->save($ultrasoundExaminationItems);
                    //dd($ultrasoundExaminationItems);
                }
                $this->setPatientLabTests($patientId, $hospitalId);
            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_ULTRASOUND_DETAILS_SAVE_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_ULTRASOUND_DETAILS_SAVE_ERROR, $exc);
        }

        return $status;
    }

    public function savePatientUrineTests(PatientUrineExaminationViewModel $patientUrineVM)
    {
        $status = true;

        try {
            $patientId = $patientUrineVM->getPatientId();
            $doctorId = $patientUrineVM->getDoctorId();
            $hospitalId = $patientUrineVM->getHospitalId();
            //$patientUser = User::find($patientId);

            $patientExaminations = $patientUrineVM->getExaminations();
            $examinationDate = $patientUrineVM->getExaminationDate();
            $examinationTime = $patientUrineVM->getExaminationTime();


            /*$doctor = Helper::checkDoctorExists($doctorId);

            if(is_null($doctor))
            {
                throw new UserNotFoundException(null, ErrorEnum::USER_NOT_FOUND, null);
            }

            $hospital = Helper::checkHospitalExists($hospitalId);

            if(is_null($hospital))
            {
                throw new UserNotFoundException(null, ErrorEnum::HOSPITAL_USER_NOT_FOUND, null);
            }*/

            $patient = Helper::checkPatientExists($patientId);
            $date = date('Y-m-d');
            $doctorappment = DB::table('doctor_appointment')->where('patient_id', '=', $patient[0])->where('appointment_date', '=', $date)->select('patient_id')->get();


            if (is_null($doctorappment)) {
                //$appointments = $patientProfileVM->getAppointment();
                $appointmentStatus = AppointmentType::APPOINTMENT_OPEN;
                $doctorAppointment = new DoctorAppointment();

                $doctorAppointment->patient_id = $patientId;
                $doctorAppointment->doctor_id = $doctorId;
                $doctorAppointment->hospital_id = $hospitalId;
                $doctorAppointment->brief_history = "BloodTest";
                $doctorAppointment->appointment_date = date('Y-m-d');
                $doctorAppointment->appointment_time =
                $doctorAppointment->appointment_category = $examinationTime;
                $doctorAppointment->appointment_status_id = $appointmentStatus;
                //BY PRASANTH 24-01-2018 START//
                //we are adding+1 for existing count value for display current TokenID
                // $patientTokenId=intval($patientTokenId)+1;


                $patientTokenId = $this->generateTokenId($hospitalId, $doctorId, $examinationDate);
                //dd($patientTokenId);
                //$patientTokenId=intval($patientTokenId)+1;
                $doctorAppointment->token_id = $patientTokenId;
                //BY PRASANTH 24-01-2018 END//
                $doctorAppointment->referral_type = "";
                $doctorAppointment->referral_doctor = "";
                $doctorAppointment->referral_hospital = "";
                $doctorAppointment->referral_hospital_location = "";
                $doctorAppointment->fee = 200;
                $doctorAppointment->payment_type = "card";
                $doctorAppointment->created_by = "Admin";
                $doctorAppointment->modified_by = "Admin";
                $doctorAppointment->created_at = date("Y-m-d H:i:s");
                $doctorAppointment->updated_at = date("Y-m-d H:i:s");

                $doctorUser = $doctorAppointment->save();

            }
            if (!is_null($patient)) {
                //DB::table('patient_family_illness')->where('patient_id', $patientId)->delete();
                $patientUser = User::find($patientId);

                foreach ($patientExaminations as $examination) {
                    //dd($patientHistory);
                    $examinationId = $examination->examinationId;
                    $isValueSet = $examination->isValueSet;
                    //$pregnancyDate = $pregnancy->pregnancyDate;

                    $examinationDate = property_exists($examination, 'examinationDate') ? $examination->examinationDate : null;
                    $examinationTime = (isset($examination->examinationTime)) ? $examination->examinationTime : null;

                    if (!is_null($examinationDate)) {
                        $patientExaminationDate = date('Y-m-d', strtotime($examinationDate));
                    } else {
                        $patientExaminationDate = null;
                    }

                    $patientUser->patienturineexaminations()->attach($examinationId,
                        array('examination_date' => $patientExaminationDate,
                            'examination_time' => $examinationTime,
                            'is_value_set' => $isValueSet,
                            'doctor_id' => $doctorId,
                            'hospital_id' => $hospitalId,
                            'created_by' => 'Admin',
                            'modified_by' => 'Admin',
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s"),
                        ));

                }

            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_URINE_DETAILS_SAVE_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_URINE_DETAILS_SAVE_ERROR, $exc);
        }

        return $status;
    }

    public function savePatientUrineTestsNew(PatientUrineExaminationViewModel $patientUrineVM)
    {
        $status = true;
        //$hospitalLabId = null;

        try {
            $patientId = $patientUrineVM->getPatientId();
            $doctorId = $patientUrineVM->getDoctorId();
            //$labId = $patientUrineVM->getLabId();
            //dd($doctorId);
            $hospitalId = $patientUrineVM->getHospitalId();
            //$patientUser = User::find($patientId);

            $urineExaminations = $patientUrineVM->getExaminations();
            $examinationDate = $patientUrineVM->getExaminationDate();
            $examinationTime = $patientUrineVM->getExaminationTime();

            $urineExamCategory = CA::get('constants.URINE_EXAMINATION_CATEGORY');
            //dd($examinationDate);

            /*$doctor = Helper::checkDoctorExists($doctorId);

            if(is_null($doctor))
            {
                throw new UserNotFoundException(null, ErrorEnum::USER_NOT_FOUND, null);
            }

            $hospital = Helper::checkHospitalExists($hospitalId);

            if(is_null($hospital))
            {
                throw new UserNotFoundException(null, ErrorEnum::HOSPITAL_USER_NOT_FOUND, null);
            }*/

            $patient = Helper::checkPatientExists($patientId);
            $date = date('Y-m-d');
            $doctorappment = DB::table('doctor_appointment')->where('patient_id', '=', $patient[0])->where('appointment_date', '=', $date)->select('patient_id')->get();


            if (is_null($doctorappment)) {
                //$appointments = $patientProfileVM->getAppointment();
                $appointmentStatus = AppointmentType::APPOINTMENT_OPEN;
                $doctorAppointment = new DoctorAppointment();

                $doctorAppointment->patient_id = $patientId;
                $doctorAppointment->doctor_id = $doctorId;
                $doctorAppointment->hospital_id = $hospitalId;
                $doctorAppointment->brief_history = "BloodTest";
                $doctorAppointment->appointment_date = date('Y-m-d');
                $doctorAppointment->appointment_time =
                $doctorAppointment->appointment_category = $examinationTime;
                $doctorAppointment->appointment_status_id = $appointmentStatus;
                //BY PRASANTH 24-01-2018 START//
                //we are adding+1 for existing count value for display current TokenID
                // $patientTokenId=intval($patientTokenId)+1;


                $patientTokenId = $this->generateTokenId($hospitalId, $doctorId, $examinationDate);
                //dd($patientTokenId);
                //$patientTokenId=intval($patientTokenId)+1;
                $doctorAppointment->token_id = $patientTokenId;
                //BY PRASANTH 24-01-2018 END//
                $doctorAppointment->referral_type = "";
                $doctorAppointment->referral_doctor = "";
                $doctorAppointment->referral_hospital = "";
                $doctorAppointment->referral_hospital_location = "";
                $doctorAppointment->fee = 200;
                $doctorAppointment->payment_type = "card";
                $doctorAppointment->created_by = "Admin";
                $doctorAppointment->modified_by = "Admin";
                $doctorAppointment->created_at = date("Y-m-d H:i:s");
                $doctorAppointment->updated_at = date("Y-m-d H:i:s");

                $doctorUser = $doctorAppointment->save();

            }
            if (!is_null($patient)) {
                //$patientUser = User::find($patientId);
                //DB::table('patient_family_illness')->where('patient_id', $patientId)->delete();
                //dd($patientDentalVM->getExaminationDate());
                //dd('Test');
                //$examinationDt = property_exists($patientBloodVM, 'examinationDate') ? $examinationDate : null;
                //dd('After Test');
                //dd($examinationDt);

                if (!is_null($examinationDate)) {
                    $patientExaminationDate = date('Y-m-d', strtotime($examinationDate));
                } else {
                    $patientExaminationDate = null;
                }

                /*if(is_null($labId))
                {
                    $hospitalLabId = $this->getLabIdForHospital($hospitalId);
                }*/

                //dd($patientExaminationDate);

                $urineExamination = new PatientUrineExamination();
                $urineExamination->patient_id = $patientId;
                $urineExamination->hospital_id = $hospitalId;
                $urineExamination->doctor_id = $doctorId;
                //$urineExamination->lab_id = $hospitalLabId;
                $urineExamination->examination_date = $patientExaminationDate;
                $urineExamination->examination_time = $examinationTime;
                $urineExamination->created_by = $patientUrineVM->getCreatedBy();
                $urineExamination->modified_by = $patientUrineVM->getUpdatedBy();
                $urineExamination->created_at = $patientUrineVM->getCreatedAt();
                $urineExamination->updated_at = $patientUrineVM->getUpdatedAt();
                //$patientBloodExamination = $bloodExamination->save();
                $urineExamination->save();

                /*foreach($urineExaminations as $examination)
                {
                    //dd($bloodExaminations);
                    //$examinationId = $examination->examinationId;

                    $urineExaminationItems = new PatientUrineExaminationItems();
                    $urineExaminationItems->urine_examination_id = $examination->examinationId;

                    $urineExaminationItems->is_value_set = $examination->isValueSet;
                    $urineExaminationItems->created_by = $patientUrineVM->getCreatedBy();
                    $urineExaminationItems->modified_by = $patientUrineVM->getUpdatedBy();
                    $urineExaminationItems->created_at = $patientUrineVM->getCreatedAt();
                    $urineExaminationItems->updated_at = $patientUrineVM->getUpdatedAt();

                    $urineExamination->urineexaminationitems()->save($urineExaminationItems);

                }*/

                foreach ($urineExaminations as $examination) {

                    //dd($bloodExaminations);
                    $examinationId = $examination->examinationId;
                    $isValueSet = $examination->isValueSet;

                    if (in_array($examinationId, $urineExamCategory)) {

                        //dd($examinationId);
                        $categoryQuery = DB::table('urine_examination as ue')->where('ue.parent_id', '=', $examinationId);
                        $categoryQuery->where('ue.has_child', '!=', 1);
                        $categoryQuery->where('ue.status', '=', 1);
                        $categoryQuery->select('id');

                        //dd($categoryQuery->toSql());

                        $categoryItems = $categoryQuery->get();
                        //dd($categoryItems);

                        foreach ($categoryItems as $item) {
                            //dd($item);
                            $urineExaminationItems = new PatientUrineExaminationItems();

                            $urineExaminationItems->urine_examination_id = $item->id;
                            $urineExaminationItems->is_value_set = $examination->isValueSet;
                            $urineExaminationItems->created_by = $patientUrineVM->getCreatedBy();
                            $urineExaminationItems->modified_by = $patientUrineVM->getUpdatedBy();
                            $urineExaminationItems->created_at = $patientUrineVM->getCreatedAt();
                            $urineExaminationItems->updated_at = $patientUrineVM->getUpdatedAt();

                            $urineExamination->urineexaminationitems()->save($urineExaminationItems);
                        }
                        /*if($isValueSet == 1)
                        {

                        }*/


                    } else {
                        $urineExaminationItems = new PatientUrineExaminationItems();

                        $urineExaminationItems->urine_examination_id = $examination->examinationId;
                        $urineExaminationItems->is_value_set = $examination->isValueSet;
                        $urineExaminationItems->created_by = $patientUrineVM->getCreatedBy();
                        $urineExaminationItems->modified_by = $patientUrineVM->getUpdatedBy();
                        $urineExaminationItems->created_at = $patientUrineVM->getCreatedAt();
                        $urineExaminationItems->updated_at = $patientUrineVM->getUpdatedAt();

                        $urineExamination->urineexaminationitems()->save($urineExaminationItems);
                    }

                }

                $this->setPatientLabTests($patientId, $hospitalId);

            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_URINE_DETAILS_SAVE_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_URINE_DETAILS_SAVE_ERROR, $exc);
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

    public function savePatientMotionTests(PatientUrineExaminationViewModel $patientMotionVM)
    {
        $status = true;

        try {
            $patientId = $patientMotionVM->getPatientId();
            $doctorId = $patientMotionVM->getDoctorId();
            $hospitalId = $patientMotionVM->getHospitalId();
            //$patientUser = User::find($patientId);

            $patientExaminations = $patientMotionVM->getExaminations();
            $examinationDate = $patientMotionVM->getExaminationDate();
            $examinationTime = $patientMotionVM->getExaminationTime();


            /*$doctor = Helper::checkDoctorExists($doctorId);

            if(is_null($doctor))
            {
                throw new UserNotFoundException(null, ErrorEnum::USER_NOT_FOUND, null);
            }

            $hospital = Helper::checkHospitalExists($hospitalId);

            if(is_null($hospital))
            {
                throw new UserNotFoundException(null, ErrorEnum::HOSPITAL_USER_NOT_FOUND, null);
            }*/

            $patient = Helper::checkPatientExists($patientId);
            $date = date('Y-m-d');
            $doctorappment = DB::table('doctor_appointment')->where('patient_id', '=', $patient[0])->where('appointment_date', '=', $date)->select('patient_id')->get();


            if (is_null($doctorappment)) {
                //$appointments = $patientProfileVM->getAppointment();
                $appointmentStatus = AppointmentType::APPOINTMENT_OPEN;
                $doctorAppointment = new DoctorAppointment();

                $doctorAppointment->patient_id = $patientId;
                $doctorAppointment->doctor_id = $doctorId;
                $doctorAppointment->hospital_id = $hospitalId;
                $doctorAppointment->brief_history = "BloodTest";
                $doctorAppointment->appointment_date = date('Y-m-d');
                $doctorAppointment->appointment_time =
                $doctorAppointment->appointment_category = $examinationTime;
                $doctorAppointment->appointment_status_id = $appointmentStatus;
                //BY PRASANTH 24-01-2018 START//
                //we are adding+1 for existing count value for display current TokenID
                // $patientTokenId=intval($patientTokenId)+1;


                $patientTokenId = $this->generateTokenId($hospitalId, $doctorId, $examinationDate);
                //dd($patientTokenId);
                //$patientTokenId=intval($patientTokenId)+1;
                $doctorAppointment->token_id = $patientTokenId;
                //BY PRASANTH 24-01-2018 END//
                $doctorAppointment->referral_type = "";
                $doctorAppointment->referral_doctor = "";
                $doctorAppointment->referral_hospital = "";
                $doctorAppointment->referral_hospital_location = "";
                $doctorAppointment->fee = 200;
                $doctorAppointment->payment_type = "card";
                $doctorAppointment->created_by = "Admin";
                $doctorAppointment->modified_by = "Admin";
                $doctorAppointment->created_at = date("Y-m-d H:i:s");
                $doctorAppointment->updated_at = date("Y-m-d H:i:s");

                $doctorUser = $doctorAppointment->save();

            }
            if (!is_null($patient)) {
                //DB::table('patient_family_illness')->where('patient_id', $patientId)->delete();
                $patientUser = User::find($patientId);

                foreach ($patientExaminations as $examination) {
                    //dd($patientHistory);
                    $examinationId = $examination->examinationId;
                    $isValueSet = $examination->isValueSet;
                    //$pregnancyDate = $pregnancy->pregnancyDate;

                    $examinationDate = property_exists($examination, 'examinationDate') ? $examination->examinationDate : null;
                    $examinationTime = (isset($examination->examinationTime)) ? $examination->examinationTime : null;

                    if (!is_null($examinationDate)) {
                        $patientExaminationDate = date('Y-m-d', strtotime($examinationDate));
                    } else {
                        $patientExaminationDate = null;
                    }

                    $patientUser->patientmotionexaminations()->attach($examinationId,
                        array('examination_date' => $patientExaminationDate,
                            'examination_time' => $examinationTime,
                            'is_value_set' => $isValueSet,
                            'doctor_id' => $doctorId,
                            'hospital_id' => $hospitalId,
                            'created_by' => 'Admin',
                            'modified_by' => 'Admin',
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s"),
                        ));

                }

            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_MOTION_DETAILS_SAVE_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_MOTION_DETAILS_SAVE_ERROR, $exc);
        }

        return $status;
    }

    public function savePatientMotionTestsNew(PatientUrineExaminationViewModel $patientMotionVM)
    {
        $status = true;
        //$hospitalLabId = null;

        try {
            $patientId = $patientMotionVM->getPatientId();
            $doctorId = $patientMotionVM->getDoctorId();
            //dd($doctorId);
            $hospitalId = $patientMotionVM->getHospitalId();
            //$labId = $patientMotionVM->getLabId();
            //$patientUser = User::find($patientId);

            $motionExaminations = $patientMotionVM->getExaminations();
            $examinationDate = $patientMotionVM->getExaminationDate();
            $examinationTime = $patientMotionVM->getExaminationTime();
            //dd($examinationDate);

            /*$doctor = Helper::checkDoctorExists($doctorId);

            if(is_null($doctor))
            {
                throw new UserNotFoundException(null, ErrorEnum::USER_NOT_FOUND, null);
            }

            $hospital = Helper::checkHospitalExists($hospitalId);

            if(is_null($hospital))
            {
                throw new UserNotFoundException(null, ErrorEnum::HOSPITAL_USER_NOT_FOUND, null);
            }*/
            //dd($patientId);
            $patient = Helper::checkPatientExists($patientId);
            $date = date('Y-m-d');
            $doctorappment = DB::table('doctor_appointment')->where('patient_id', '=', $patient[0])->where('appointment_date', '=', $date)->select('patient_id')->get();

            if (is_null($doctorappment)) {
                //$appointments = $patientProfileVM->getAppointment();
                $appointmentStatus = AppointmentType::APPOINTMENT_OPEN;
                $doctorAppointment = new DoctorAppointment();

                $doctorAppointment->patient_id = $patientId;
                $doctorAppointment->doctor_id = $doctorId;
                $doctorAppointment->hospital_id = $hospitalId;
                $doctorAppointment->brief_history = "BloodTest";
                $doctorAppointment->appointment_date = date('Y-m-d');
                $doctorAppointment->appointment_time =
                $doctorAppointment->appointment_category = $examinationTime;
                $doctorAppointment->appointment_status_id = $appointmentStatus;
                //BY PRASANTH 24-01-2018 START//
                //we are adding+1 for existing count value for display current TokenID
                // $patientTokenId=intval($patientTokenId)+1;


                $patientTokenId = $this->generateTokenId($hospitalId, $doctorId, $examinationDate);
                //dd($patientTokenId);
                //$patientTokenId=intval($patientTokenId)+1;
                $doctorAppointment->token_id = $patientTokenId;
                //BY PRASANTH 24-01-2018 END//
                $doctorAppointment->referral_type = "";
                $doctorAppointment->referral_doctor = "";
                $doctorAppointment->referral_hospital = "";
                $doctorAppointment->referral_hospital_location = "";
                $doctorAppointment->fee = 200;
                $doctorAppointment->payment_type = "card";
                $doctorAppointment->created_by = "Admin";
                $doctorAppointment->modified_by = "Admin";
                $doctorAppointment->created_at = date("Y-m-d H:i:s");
                $doctorAppointment->updated_at = date("Y-m-d H:i:s");

                $doctorUser = $doctorAppointment->save();

            }
            if (!is_null($patient)) {
                //$patientUser = User::find($patientId);
                //DB::table('patient_family_illness')->where('patient_id', $patientId)->delete();
                //$examinationDt = property_exists($patientBloodVM, 'examinationDate') ? $examinationDate : null;
                if (!is_null($examinationDate)) {
                    $patientExaminationDate = date('Y-m-d', strtotime($examinationDate));
                } else {
                    $patientExaminationDate = null;
                }

                /*if(is_null($labId))
                {
                    $hospitalLabId = $this->getLabIdForHospital($hospitalId);
                }*/

                //dd($patientExaminationDate);

                $motionExamination = new PatientMotionExamination();
                $motionExamination->patient_id = $patientId;
                $motionExamination->hospital_id = $hospitalId;
                $motionExamination->doctor_id = $doctorId;
                //$motionExamination->lab_id = $hospitalLabId;
                $motionExamination->examination_date = $patientExaminationDate;
                $motionExamination->examination_time = $examinationTime;
                $motionExamination->created_by = $patientMotionVM->getCreatedBy();
                $motionExamination->modified_by = $patientMotionVM->getUpdatedBy();
                $motionExamination->created_at = $patientMotionVM->getCreatedAt();
                $motionExamination->updated_at = $patientMotionVM->getUpdatedAt();
                //$patientBloodExamination = $bloodExamination->save();
                $motionExamination->save();

                foreach ($motionExaminations as $examination) {
                    //dd($bloodExaminations);
                    //$examinationId = $examination->examinationId;
                    //$examinationName = $examination->examinationName;
                    //$pregnancyDate = $pregnancy->pregnancyDate;
                    $motionExaminationItems = new PatientMotionExaminationItems();
                    $motionExaminationItems->motion_examination_id = $examination->examinationId;
                    //$examinationDate = property_exists($patientDentalVM->getExaminationDate(), 'examinationDate') ? $examinationDate : null;

                    //$dentalExaminationItems->dental_examination_name = property_exists($examination->dentalExaminationName, 'dentalExaminationName') ? $examination->dentalExaminationName : null;
                    //$dentalExaminationItems->dental_examination_name = (isset($examination->dentalExaminationName)) ? $examination->dentalExaminationName : null;

                    //$dentalExaminationItems->dental_examination_name = $examination->dentalExaminationName;
                    $motionExaminationItems->is_value_set = $examination->isValueSet;
                    $motionExaminationItems->created_by = $patientMotionVM->getCreatedBy();
                    $motionExaminationItems->modified_by = $patientMotionVM->getUpdatedBy();
                    $motionExaminationItems->created_at = $patientMotionVM->getCreatedAt();
                    $motionExaminationItems->updated_at = $patientMotionVM->getUpdatedAt();

                    $motionExamination->motionexaminationitems()->save($motionExaminationItems);

                }

                $this->setPatientLabTests($patientId, $hospitalId);

            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_MOTION_DETAILS_SAVE_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_MOTION_DETAILS_SAVE_ERROR, $exc);
        }

        return $status;
    }

    public function savePatientScanDetails(PatientScanViewModel $patientScanVM)
    {
        //dd($patientScanVM);
        $status = true;

        try {
            $patientId = $patientScanVM->getPatientId();
            $doctorId = $patientScanVM->getDoctorId();
            $hospitalId = $patientScanVM->getHospitalId();
            //$patientUser = User::find($patientId);

            $patientScans = $patientScanVM->getPatientScans();
            $examinationDate = $patientScanVM->getExaminationDate();
            $examinationTime = $patientScanVM->getExaminationTime();

            /*$doctor = Helper::checkDoctorExists($doctorId);

            if(is_null($doctor))
            {
                throw new UserNotFoundException(null, ErrorEnum::USER_NOT_FOUND, null);
            }

            $hospital = Helper::checkHospitalExists($hospitalId);

            if(is_null($hospital))
            {
                throw new UserNotFoundException(null, ErrorEnum::HOSPITAL_USER_NOT_FOUND, null);
            }*/

            $patient = Helper::checkPatientExists($patientId);
            $date = date('Y-m-d');
            $doctorappment = DB::table('doctor_appointment')->where('patient_id', '=', $patient[0])->where('appointment_date', '=', $date)->select('patient_id')->get();


            if (is_null($doctorappment)) {
                //$appointments = $patientProfileVM->getAppointment();
                $appointmentStatus = AppointmentType::APPOINTMENT_OPEN;
                $doctorAppointment = new DoctorAppointment();

                $doctorAppointment->patient_id = $patientId;
                $doctorAppointment->doctor_id = $doctorId;
                $doctorAppointment->hospital_id = $hospitalId;
                $doctorAppointment->brief_history = "BloodTest";
                $doctorAppointment->appointment_date = date('Y-m-d');
                $doctorAppointment->appointment_time =
                $doctorAppointment->appointment_category = $examinationTime;
                $doctorAppointment->appointment_status_id = $appointmentStatus;
                //BY PRASANTH 24-01-2018 START//
                //we are adding+1 for existing count value for display current TokenID
                // $patientTokenId=intval($patientTokenId)+1;


                $patientTokenId = $this->generateTokenId($hospitalId, $doctorId, $examinationDate);
                //dd($patientTokenId);
                //$patientTokenId=intval($patientTokenId)+1;
                $doctorAppointment->token_id = $patientTokenId;
                //BY PRASANTH 24-01-2018 END//
                $doctorAppointment->referral_type = "";
                $doctorAppointment->referral_doctor = "";
                $doctorAppointment->referral_hospital = "";
                $doctorAppointment->referral_hospital_location = "";
                $doctorAppointment->fee = 200;
                $doctorAppointment->payment_type = "card";
                $doctorAppointment->created_by = "Admin";
                $doctorAppointment->modified_by = "Admin";
                $doctorAppointment->created_at = date("Y-m-d H:i:s");
                $doctorAppointment->updated_at = date("Y-m-d H:i:s");

                $doctorUser = $doctorAppointment->save();

            }
            if (!is_null($patient)) {
                //dd('in');
                //DB::table('patient_family_illness')->where('patient_id', $patientId)->delete();

                $patientUser = User::find($patientId);

                foreach ($patientScans as $scans) {
                    //dd($patientHistory);
                    $scanId = $scans->scanId;
                    $isValueSet = $scans->isValueSet;
                    //$pregnancyDate = $pregnancy->pregnancyDate;

                    $scanDate = property_exists($scans, 'scanDate') ? $scans->scanDate : null;
                    $examinationTime = (isset($scans->examinationTime)) ? $scans->examinationTime : null;

                    if (!is_null($scanDate)) {
                        $patientScanDate = date('Y-m-d', strtotime($scanDate));
                    } else {
                        $patientScanDate = null;
                    }

                    $patientUser->patientscans()->attach($scanId,
                        array('scan_date' => $patientScanDate,
                            'examination_time' => $examinationTime,
                            'is_value_set' => $isValueSet,
                            'doctor_id' => $doctorId,
                            'hospital_id' => $hospitalId,
                            'created_by' => 'Admin',
                            'modified_by' => 'Admin',
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s"),
                        ));

                }

            } else {
                //dd('out');
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_SCAN_SAVE_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_SCAN_SAVE_ERROR, $exc);
        }

        return $status;
    }

    public function savePatientScanDetailsNew(PatientScanViewModel $patientScanVM)
    {
        $status = true;
        //$hospitalLabId = null;

        try {
            //dd($patientScanVM);
            $patientId = $patientScanVM->getPatientId();
            $doctorId = $patientScanVM->getDoctorId();
            //dd($doctorId);
            $hospitalId = $patientScanVM->getHospitalId();
            //$labId = $patientScanVM->getLabId();
            //$patientUser = User::find($patientId);

            $patientScans = $patientScanVM->getPatientScans();
            $examinationDate = $patientScanVM->getExaminationDate();
            $examinationTime = $patientScanVM->getExaminationTime();
            //dd($examinationDate);

            /*$doctor = Helper::checkDoctorExists($doctorId);

            if(is_null($doctor))
            {
                throw new UserNotFoundException(null, ErrorEnum::USER_NOT_FOUND, null);
            }

            $hospital = Helper::checkHospitalExists($hospitalId);

            if(is_null($hospital))
            {
                throw new UserNotFoundException(null, ErrorEnum::HOSPITAL_USER_NOT_FOUND, null);
            }*/

            $patient = Helper::checkPatientExists($patientId);
            $date = date('Y-m-d');
            $doctorappment = DB::table('doctor_appointment')->where('patient_id', '=', $patient[0])->where('appointment_date', '=', $date)->select('patient_id')->get();


            if (is_null($doctorappment)) {
                //$appointments = $patientProfileVM->getAppointment();
                $appointmentStatus = AppointmentType::APPOINTMENT_OPEN;
                $doctorAppointment = new DoctorAppointment();

                $doctorAppointment->patient_id = $patientId;
                $doctorAppointment->doctor_id = $doctorId;
                $doctorAppointment->hospital_id = $hospitalId;
                $doctorAppointment->brief_history = "BloodTest";
                $doctorAppointment->appointment_date = date('Y-m-d');
                $doctorAppointment->appointment_time =
                $doctorAppointment->appointment_category = $examinationTime;
                $doctorAppointment->appointment_status_id = $appointmentStatus;
                //BY PRASANTH 24-01-2018 START//
                //we are adding+1 for existing count value for display current TokenID
                // $patientTokenId=intval($patientTokenId)+1;


                $patientTokenId = $this->generateTokenId($hospitalId, $doctorId, $examinationDate);
                //dd($patientTokenId);
                //$patientTokenId=intval($patientTokenId)+1;
                $doctorAppointment->token_id = $patientTokenId;
                //BY PRASANTH 24-01-2018 END//
                $doctorAppointment->referral_type = "";
                $doctorAppointment->referral_doctor = "";
                $doctorAppointment->referral_hospital = "";
                $doctorAppointment->referral_hospital_location = "";
                $doctorAppointment->fee = 200;
                $doctorAppointment->payment_type = "card";
                $doctorAppointment->created_by = "Admin";
                $doctorAppointment->modified_by = "Admin";
                $doctorAppointment->created_at = date("Y-m-d H:i:s");
                $doctorAppointment->updated_at = date("Y-m-d H:i:s");

                $doctorUser = $doctorAppointment->save();

            }
            if (!is_null($patient)) {
                //$patientUser = User::find($patientId);
                //DB::table('patient_family_illness')->where('patient_id', $patientId)->delete();
                //dd($patientDentalVM->getExaminationDate());
                //dd('Test');
                //$examinationDt = property_exists($patientBloodVM, 'examinationDate') ? $examinationDate : null;
                //dd('After Test');
                //dd($examinationDt);

                if (!is_null($examinationDate)) {
                    $patientExaminationDate = date('Y-m-d', strtotime($examinationDate));
                } else {
                    $patientExaminationDate = null;
                }

                /*if(is_null($labId))
                {
                    $hospitalLabId = $this->getLabIdForHospital($hospitalId);
                }*/

                //dd($patientExaminationDate);

                $scanExamination = new PatientScanExamination();
                $scanExamination->patient_id = $patientId;
                $scanExamination->hospital_id = $hospitalId;
                $scanExamination->doctor_id = $doctorId;
                //$scanExamination->lab_id = $hospitalLabId;
                $scanExamination->scan_date = $patientExaminationDate;
                $scanExamination->examination_time = $examinationTime;
                $scanExamination->created_by = $patientScanVM->getCreatedBy();
                $scanExamination->modified_by = $patientScanVM->getUpdatedBy();
                $scanExamination->created_at = $patientScanVM->getCreatedAt();
                $scanExamination->updated_at = $patientScanVM->getUpdatedAt();
                //$patientBloodExamination = $bloodExamination->save();
                $scanExamination->save();

                foreach ($patientScans as $examination) {
                    //dd($bloodExaminations);
                    //$examinationId = $examination->examinationId;
                    //$examinationName = $examination->examinationName;
                    //$pregnancyDate = $pregnancy->pregnancyDate;
                    $scanExaminationItems = new PatientScanExaminationItems();
                    $scanExaminationItems->scan_id = $examination->scanId;
                    //$examinationDate = property_exists($patientDentalVM->getExaminationDate(), 'examinationDate') ? $examinationDate : null;

                    //$dentalExaminationItems->dental_examination_name = property_exists($examination->dentalExaminationName, 'dentalExaminationName') ? $examination->dentalExaminationName : null;
                    //$dentalExaminationItems->dental_examination_name = (isset($examination->dentalExaminationName)) ? $examination->dentalExaminationName : null;

                    //$dentalExaminationItems->dental_examination_name = $examination->dentalExaminationName;
                    $scanExaminationItems->is_value_set = $examination->isValueSet;
                    $scanExaminationItems->created_by = $patientScanVM->getCreatedBy();
                    $scanExaminationItems->modified_by = $patientScanVM->getUpdatedBy();
                    $scanExaminationItems->created_at = $patientScanVM->getCreatedAt();
                    $scanExaminationItems->updated_at = $patientScanVM->getUpdatedAt();

                    $scanExamination->scanexaminationitems()->save($scanExaminationItems);

                }

                $query1 = PatientLabTest::where('patient_id', '=', $patientId)->where('hospital_id', '=', $hospitalId);
                //dd($query1->toSql());

                /*if($count == 0) {
                    $patientLabTest = new PatientLabTests();
                    $patientLabTest->patient_id = $patientId;
                    $patientLabTest->hospital_id = $hospitalId;
                    $patientLabTest->created_by = 'Admin';
                    $patientLabTest->modified_by = 'Admin';
                    $patientLabTest->created_at = date("Y-m-d H:i:s");
                    $patientLabTest->updated_at = date("Y-m-d H:i:s");

                    $patientLabTest->save();
                }*/

                //$this->setPatientLabTests($patientId, $hospitalId);

            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_SCAN_SAVE_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_SCAN_SAVE_ERROR, $exc);
        }

        return $status;
    }

    public function savePatientDentalTests(PatientDentalViewModel $patientDentalVM)
    {
        $status = true;
        $patientExaminationDate = null;
        $patientDentalExamination = null;

        try {
            $patientId = $patientDentalVM->getPatientId();
            $doctorId = $patientDentalVM->getDoctorId();
            $hospitalId = $patientDentalVM->getHospitalId();

            $dentalExaminations = $patientDentalVM->getExaminations();
            $examinationDate = $patientDentalVM->getExaminationDate();
            $examinationTime = $patientDentalVM->getExaminationTime();

            $patient = Helper::checkPatientExists($patientId);
            $date = date('Y-m-d');
            $doctorappment = DB::table('doctor_appointment')->where('patient_id', '=', $patient[0])->where('appointment_date', '=', $date)->select('patient_id')->get();


            if (is_null($doctorappment)) {
                //$appointments = $patientProfileVM->getAppointment();
                $appointmentStatus = AppointmentType::APPOINTMENT_OPEN;
                $doctorAppointment = new DoctorAppointment();

                $doctorAppointment->patient_id = $patientId;
                $doctorAppointment->doctor_id = $doctorId;
                $doctorAppointment->hospital_id = $hospitalId;
                $doctorAppointment->brief_history = "BloodTest";
                $doctorAppointment->appointment_date = date('Y-m-d');
                $doctorAppointment->appointment_time =
                $doctorAppointment->appointment_category = $examinationTime;
                $doctorAppointment->appointment_status_id = $appointmentStatus;
                //BY PRASANTH 24-01-2018 START//
                //we are adding+1 for existing count value for display current TokenID
                // $patientTokenId=intval($patientTokenId)+1;


                $patientTokenId = $this->generateTokenId($hospitalId, $doctorId, $examinationDate);
                //dd($patientTokenId);
                //$patientTokenId=intval($patientTokenId)+1;
                $doctorAppointment->token_id = $patientTokenId;
                //BY PRASANTH 24-01-2018 END//
                $doctorAppointment->referral_type = "";
                $doctorAppointment->referral_doctor = "";
                $doctorAppointment->referral_hospital = "";
                $doctorAppointment->referral_hospital_location = "";
                $doctorAppointment->fee = 200;
                $doctorAppointment->payment_type = "card";
                $doctorAppointment->created_by = "Admin";
                $doctorAppointment->modified_by = "Admin";
                $doctorAppointment->created_at = date("Y-m-d H:i:s");
                $doctorAppointment->updated_at = date("Y-m-d H:i:s");

                $doctorUser = $doctorAppointment->save();

            }
            if (!is_null($patient)) {

                if (!is_null($examinationDate)) {
                    $patientExaminationDate = date('Y-m-d', strtotime($examinationDate));
                } else {
                    $patientExaminationDate = null;
                }

                $dentalExamination = new PatientDentalExamination();
                $dentalExamination->patient_id = $patientId;
                $dentalExamination->hospital_id = $hospitalId;
                $dentalExamination->doctor_id = $patientDentalVM->getDoctorId();
                //$dentalExamination->lab_id = $hospitalLabId;
                $dentalExamination->examination_date = $patientExaminationDate;
                $dentalExamination->examination_time = $examinationTime;
                $dentalExamination->created_by = $patientDentalVM->getCreatedBy();
                $dentalExamination->modified_by = $patientDentalVM->getUpdatedBy();
                $dentalExamination->created_at = $patientDentalVM->getCreatedAt();
                $dentalExamination->updated_at = $patientDentalVM->getUpdatedAt();
                $dentalExamination->save();

                foreach ($dentalExaminations as $examination) {
                    //$examinationId = $examination->examinationId;
                    //$examinationName = $examination->examinationName;
                    //$pregnancyDate = $pregnancy->pregnancyDate;
                    $dentalExaminationItems = new PatientDentalExaminationItems();
                    $dentalExaminationItems->dental_examination_item_id = $examination->dentalExaminationId;
                    //$examinationDate = property_exists($patientDentalVM->getExaminationDate(), 'examinationDate') ? $examinationDate : null;

                    //$dentalExaminationItems->dental_examination_name = property_exists($examination->dentalExaminationName, 'dentalExaminationName') ? $examination->dentalExaminationName : null;
                    $dentalExaminationItems->dental_examination_name = (isset($examination->dentalExaminationName)) ? $examination->dentalExaminationName : null;

                    //$dentalExaminationItems->dental_examination_name = $examination->dentalExaminationName;
                    $dentalExaminationItems->created_by = $patientDentalVM->getCreatedBy();
                    $dentalExaminationItems->modified_by = $patientDentalVM->getUpdatedBy();
                    $dentalExaminationItems->created_at = $patientDentalVM->getCreatedAt();
                    $dentalExaminationItems->updated_at = $patientDentalVM->getUpdatedAt();
                    if (!is_null($dentalExaminationItems->dental_examination_name)) {
                        $dentalExamination->dentalexaminationitems()->save($dentalExaminationItems);
                    }
                }

                $this->setPatientLabTests($patientId, $hospitalId);

            } else {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
            throw new LabException(null, ErrorEnum::PATIENT_DENTAL_TESTS_SAVE_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new LabException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
            throw new LabException(null, ErrorEnum::PATIENT_DENTAL_TESTS_SAVE_ERROR, $exc);
        }

        return $status;
    }


    public function getExaminationDates($patientId, $hospitalId)
    {
        $examinationDates = null;
        $generalExaminationDates = null;
        $pastIllnessDates = null;
        //$drugDates = null;

        $scanDates = null;
        $ultraSoundDates = null;
        $bloodTestDates = null;
        $urineTestDates = null;
        $motionTestDates = null;
        $dentalTestDates = null;

        $patientLabTests = null;

        $latestPrescription = null;
        try {
            $patientUser = User::find($patientId);

            if (is_null($patientUser)) {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }

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

            //$query = DB::getQueryLog();

            $latestSymptomsQuery = DB::table('patient_symptoms as ps');
            $latestSymptomsQuery->join('main_symptoms as ms', 'ms.id', '=', 'ps.main_symptom_id');
            $latestSymptomsQuery->join('sub_symptoms as ss', 'ss.id', '=', 'ps.sub_symptom_id');
            $latestSymptomsQuery->join('symptoms as s', 's.id', '=', 'ps.symptom_id');
            $latestSymptomsQuery->where('ps.patient_symptom_date', function ($query) use ($patientId) {
                $query->select(DB::raw('MAX(ps.patient_symptom_date)'));
                $query->from('patient_symptoms as ps')->where('ps.patient_id', '=', $patientId);
            });


            $latestUltrasoundQuery = DB::table('patient_ultra_sound as pus');
            $latestUltrasoundQuery->join('patient_ultra_sound_item as pusi', 'pusi.patient_ultra_sound_id', '=', 'pus.id');
            $latestUltrasoundQuery->join('ultra_sound as us', 'us.id', '=', 'pusi.ultra_sound_id');
            $latestUltrasoundQuery->where('pus.examination_date', function ($query) use ($patientId) {
                $query->select(DB::raw('MAX(pus.examination_date)'));
                $query->from('patient_ultra_sound as pus')->where('pus.patient_id', '=', $patientId);
            });
            $latestUltrasoundQuery->where('pus.examination_time', function ($query) use ($patientId) {
                $query->select(DB::raw('MAX(pus.examination_time)'));
                $query->from('patient_ultra_sound as pus')->where('pus.patient_id', '=', $patientId);
                $query->where('pus.examination_date', function ($query1) use ($patientId) {
                    $query1->select(DB::raw('MAX(pus.examination_date)'));
                    $query1->from('patient_ultra_sound as pus')->where('pus.patient_id', '=', $patientId);
                });
            });
            $latestUltrasoundQuery->where('pus.patient_id', '=', $patientId);
            $latestUltrasoundQuery->where('pusi.is_value_set', '=', 1);
            $latestUltrasoundQuery->select('pus.id as examinationId', 'pusi.id as examinationItemId',
                'pus.patient_id', 'us.examination_name', 'pus.examination_date');
            $latestUltrasound = $latestUltrasoundQuery->get();

            $latestUrineExamQuery = DB::table('patient_urine_examination as pue');
            $latestUrineExamQuery->join('patient_urine_examination_item as puei', 'puei.patient_urine_examination_id', '=', 'pue.id');
            $latestUrineExamQuery->join('urine_examination as ue', 'ue.id', '=', 'puei.urine_examination_id');
            $latestUrineExamQuery->where('pue.examination_date', function ($query) use ($patientId) {
                $query->select(DB::raw('MAX(pue.examination_date)'));
                $query->from('patient_urine_examination as pue')->where('pue.patient_id', '=', $patientId);
            });
            $latestUrineExamQuery->where('pue.examination_time', function ($query) use ($patientId) {
                $query->select(DB::raw('MAX(pue.examination_time)'));
                $query->from('patient_urine_examination as pue')->where('pue.patient_id', '=', $patientId);
                $query->where('pue.examination_date', function ($query1) use ($patientId) {
                    $query1->select(DB::raw('MAX(pue.examination_date)'));
                    $query1->from('patient_urine_examination as pue')->where('pue.patient_id', '=', $patientId);
                });
            });
            $latestUrineExamQuery->where('pue.patient_id', '=', $patientId);
            $latestUrineExamQuery->where('puei.is_value_set', '=', 1);
            $latestUrineExamQuery->select('pue.id as examinationId', 'puei.id as examinationItemId',
                'pue.patient_id', 'ue.examination_name', 'pue.examination_date');
            $latestUrineExaminations = $latestUrineExamQuery->get();

            $latestMotionExamQuery = DB::table('patient_motion_examination as pme');
            $latestMotionExamQuery->join('patient_motion_examination_item as pmei', 'pmei.patient_motion_examination_id', '=', 'pme.id');
            $latestMotionExamQuery->join('motion_examination as me', 'me.id', '=', 'pmei.motion_examination_id');
            $latestMotionExamQuery->where('pme.examination_date', function ($query) use ($patientId) {
                $query->select(DB::raw('MAX(pme.examination_date)'));
                $query->from('patient_motion_examination as pme')->where('pme.patient_id', '=', $patientId);
            });
            $latestMotionExamQuery->where('pme.examination_time', function ($query) use ($patientId) {
                $query->select(DB::raw('MAX(pme.examination_time)'));
                $query->from('patient_motion_examination as pme')->where('pme.patient_id', '=', $patientId);
                $query->where('pme.examination_date', function ($query1) use ($patientId) {
                    $query1->select(DB::raw('MAX(pme.examination_date)'));
                    $query1->from('patient_motion_examination as pme')->where('pme.patient_id', '=', $patientId);
                });
            });
            $latestMotionExamQuery->where('pme.patient_id', '=', $patientId);
            $latestMotionExamQuery->where('pmei.is_value_set', '=', 1);
            $latestMotionExamQuery->select('pme.id as examinationId', 'pmei.id as examinationItemId',
                'pme.patient_id', 'me.examination_name', 'pme.examination_date');
            $latestMotionExaminations = $latestMotionExamQuery->get();


            $latestDentalExamQuery = DB::table('patient_dental_examination_item as pdei');
            $latestDentalExamQuery->join('patient_dental_examination as pde', 'pde.id', '=', 'pdei.patient_dental_examination_id');
            $latestDentalExamQuery->join('dental_examination_items as dei', 'dei.id', '=', 'pdei.dental_examination_item_id');
            $latestDentalExamQuery->join('dental_category as dc', 'dc.id', '=', 'dei.dental_category_id');
            $latestDentalExamQuery->where('pde.examination_date', function ($query) use ($patientId) {
                $query->select(DB::raw('MAX(pde.examination_date)'));
                $query->from('patient_dental_examination as pde')->where('pde.patient_id', '=', $patientId);
            });
            $latestDentalExamQuery->where('pde.patient_id', '=', $patientId);
            //$latestDentalExamQuery->where('pde.hospital_id', '=', $hospitalId);
            //$latestDentalExamQuery->where('pbe.is_value_set', '=', 1);
            $latestDentalExamQuery->select('pdei.id', 'pde.patient_id',
                'pde.hospital_id', 'dc.id as category_id', 'dc.category_name',
                'dei.id as examination_id', 'dei.examination_name', 'pde.examination_date');
            //dd($latestDentalExamQuery->toSql());
            $dentalExaminations = $latestDentalExamQuery->get();

            $latestXrayExamQuery = DB::table('patient_xray_examination_item as pxei');
            $latestXrayExamQuery->join('patient_xray_examination as pxe', 'pxe.id', '=', 'pxei.patient_xray_examination_id');
            $latestXrayExamQuery->join('xray_examination as xe', 'xe.id', '=', 'pxei.xray_examination_item_id');
            $latestXrayExamQuery->where('pxe.examination_date', function ($query) use ($patientId) {
                $query->select(DB::raw('MAX(pxe.examination_date)'));
                $query->from('patient_xray_examination as pxe')->where('pxe.patient_id', '=', $patientId);
            });
            $latestXrayExamQuery->where('pxe.patient_id', '=', $patientId);
            //$latestDentalExamQuery->where('pde.hospital_id', '=', $hospitalId);
            //$latestDentalExamQuery->where('pbe.is_value_set', '=', 1);
            $latestXrayExamQuery->select('pxei.id', 'pxe.patient_id',
                'pxe.hospital_id', 'xe.id as examination_id', 'xe.examination_name', 'xe.category',
                'pxe.examination_date');
            //dd($latestDentalExamQuery->toSql());
            $xrayExaminations = $latestXrayExamQuery->get();


            $scanDetailsQuery = DB::table('patient_scan as ps')->where('ps.patient_id', '=', $patientId);
            $scanDetailsQuery->select('ps.scan_date')->orderBy('ps.scan_date', 'DESC');
            $scanDates = $scanDetailsQuery->distinct()->get();
            //$scanDates = $scanDetailsQuery->distinct()->take(2147483647)->skip(1)->get();

            //$symptomDates = $symptomDatesQuery->distinct()->take(2147483647)->skip(1)->get();

            $ultraSoundDatesQuery = DB::table('patient_ultra_sound as pus')->where('pus.patient_id', '=', $patientId);
            $ultraSoundDatesQuery->select('pus.examination_date')->orderBy('pus.examination_date', 'DESC');
            $ultraSoundDates = $ultraSoundDatesQuery->distinct()->get();
            //$ultraSoundDates = $ultraSoundDatesQuery->distinct()->take(2147483647)->skip(1)->get();

            $bloodDatesQuery = DB::table('patient_blood_examination as pbe')->where('pbe.patient_id', '=', $patientId);
            $bloodDatesQuery->select('pbe.examination_date')->orderBy('pbe.examination_date', 'DESC');
            $bloodTestDates = $bloodDatesQuery->distinct()->get();
            //$bloodTestDates = $bloodDatesQuery->distinct()->take(2147483647)->skip(1)->get();

            //dd($bloodDatesQuery->toSql());

            $urineDatesQuery = DB::table('patient_urine_examination as pue')->where('pue.patient_id', '=', $patientId);
            $urineDatesQuery->select('pue.examination_date')->orderBy('pue.examination_date', 'DESC');
            $urineTestDates = $urineDatesQuery->distinct()->get();
            //$urineTestDates = $urineDatesQuery->distinct()->take(2147483647)->skip(1)->get();

            $motionDatesQuery = DB::table('patient_motion_examination as pme')->where('pme.patient_id', '=', $patientId);
            $motionDatesQuery->select('pme.examination_date')->orderBy('pme.examination_date', 'DESC');
            $motionTestDates = $motionDatesQuery->distinct()->get();

            $dentalDatesQuery = DB::table('patient_dental_examination as pde')->where('pde.patient_id', '=', $patientId);
            $dentalDatesQuery->select('pde.examination_date')->orderBy('pde.examination_date', 'DESC');
            $dentalTestDates = $dentalDatesQuery->distinct()->get();

            $xrayDatesQuery = DB::table('patient_xray_examination as pxe')->where('pxe.patient_id', '=', $patientId);
            $xrayDatesQuery->select('pxe.examination_date')->orderBy('pxe.examination_date', 'DESC');
            $xrayTestDates = $xrayDatesQuery->distinct()->get();
            //$motionTestDates = $motionDatesQuery->distinct()->take(2147483647)->skip(1)->get();

            $drugDatesQuery = DB::table('patient_drug_history as pdh')->where('pdh.patient_id', '=', $patientId);
            $drugDatesQuery->select('pdh.drug_history_date')->orderBy('pdh.drug_history_date', 'DESC');
            $drugTestDates = $drugDatesQuery->distinct()->get();

            $surgeryDatesQuery = DB::table('patient_surgeries as ps')->where('ps.patient_id', '=', $patientId);
            $surgeryDatesQuery->select('ps.surgery_input_date')->orderBy('ps.surgery_input_date', 'DESC');
            $surgeryTestDates = $surgeryDatesQuery->distinct()->get();

            $patientQuery = DB::table('patient as p')->select('p.id', 'p.patient_id', 'p.name', 'p.email', 'p.pid',
                'p.telephone', 'p.relationship', 'p.patient_spouse_name as spouseName', 'p.address');
            $patientQuery->where('p.patient_id', '=', $patientId);
            $patientDetails = $patientQuery->first();

            $hospitalQuery = DB::table('hospital as h')->select('h.id', 'h.hospital_id', 'h.hospital_name', 'h.address', 'c.city_name',
                'co.name');
            $hospitalQuery->join('cities as c', 'c.id', '=', 'h.city');
            $hospitalQuery->join('countries as co', 'co.id', '=', 'h.country');
            $hospitalQuery->where('h.hospital_id', '=', $hospitalId);
            $hospitalDetails = $hospitalQuery->first();

            $examinationDates['patientDetails'] = $patientDetails;
            $examinationDates['hospitalDetails'] = $hospitalDetails;
            $examinationDates['recentBloodTests'] = $bloodExaminations;
            $examinationDates['recentUltrasound'] = $latestUltrasound;
            $examinationDates['recentUrineExaminations'] = $latestUrineExaminations;
            $examinationDates['recentMotionExaminations'] = $latestMotionExaminations;
            $xaminationDates['dentalExaminations'] = $dentalExaminations;
            $examinationDates['xrayExaminations'] = $xrayExaminations;
            $examinationDates['latestPrescription'] = $latestPrescription;

            $examinationDates["generalExaminationDates"] = $generalExaminationDates;
            $examinationDates["pastIllnessDates"] = $pastIllnessDates;
            $examinationDates["drugTestDates"] = $drugTestDates;
            $examinationDates["surgeryTestDates"] = $surgeryTestDates;
            $examinationDates["scanDates"] = $scanDates;
            $examinationDates["ultraSoundDates"] = $ultraSoundDates;
            $examinationDates["bloodTestDates"] = $bloodTestDates;
            $examinationDates["urineTestDates"] = $urineTestDates;
            $examinationDates["motionTestDates"] = $motionTestDates;
            $examinationDates["dentalTestDates"] = $dentalTestDates;
            $examinationDates["xrayTestDates"] = $xrayTestDates;

            //dd($examinationDates);

        } catch (QueryException $queryEx) {
            //dd($queryEx);
            throw new HospitalException(null, ErrorEnum::PATIENT_EXAMINATION_DATES_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            //dd($exc);
            throw new HospitalException(null, ErrorEnum::PATIENT_EXAMINATION_DATES_ERROR, $exc);
        }

        //dd($patientLabTests);
        return $examinationDates;
    }

    public function getExaminationDatesByDate($patientId, $hospitalId, $date)
    {
        $doctorinfo = [];
        $bloodExaminations = null;
        try {
            $patientUser = User::find($patientId);

            if (is_null($patientUser)) {
                throw new UserNotFoundException(null, ErrorEnum::PATIENT_USER_NOT_FOUND, null);
            }


            $latestBloodExamQuery = DB::table('patient_blood_examination as pbe');
            $latestBloodExamQuery->join('patient_blood_examination_item as pbei', 'pbei.patient_blood_examination_id', '=', 'pbe.id');
            $latestBloodExamQuery->join('blood_examination as be', 'be.id', '=', 'pbei.blood_examination_id');
            $latestBloodExamQuery->join('blood_examination as be1', 'be1.id', '=', 'be.parent_id');
            $latestBloodExamQuery->where('pbe.examination_date', '=', $date);


            $latestBloodExamQuery->where('pbe.patient_id', '=', $patientId);
            $latestBloodExamQuery->where('pbei.is_value_set', '=', 1);
            $latestBloodExamQuery->select('pbe.id as examinationId', 'pbei.id as examinationItemId', 'pbe.patient_id',
                'pbe.hospital_id', 'be.examination_name', 'pbe.examination_date', 'pbei.test_readings', 'be.default_normal_values', 'be.is_parent', 'be1.examination_name AS parent_examination_name', 'be.units', 'pbe.doctor_id', 'pbe.fee_receipt_id');
            $bloodExaminations = $latestBloodExamQuery->get();

            // dd($latestBloodExamQuery->toSql());
            //dd($latestComplaintsQuery->toSql());

            //dd($latestComplaints);


            $latestUrineExamQuery = DB::table('patient_urine_examination as pue');
            $latestUrineExamQuery->join('patient_urine_examination_item as puei', 'puei.patient_urine_examination_id', '=', 'pue.id');
            $latestUrineExamQuery->join('urine_examination as ue', 'ue.id', '=', 'puei.urine_examination_id');
            $latestUrineExamQuery->join('urine_examination as ue1', 'ue1.id', '=', 'ue.parent_id');
            $latestUrineExamQuery->where('pue.examination_date', '=', $date);


            $latestUrineExamQuery->where('pue.patient_id', '=', $patientId);
            $latestUrineExamQuery->where('puei.is_value_set', '=', 1);
            $latestUrineExamQuery->select('pue.id as examinationId', 'puei.id as examinationItemId',
                'pue.patient_id', 'ue.examination_name', 'pue.examination_date', 'puei.test_readings', 'ue.normal_default_values', 'ue.is_parent', 'ue1.examination_name as parent_examination_name', 'pue.doctor_id', 'pue.fee_receipt_id');
            $latestUrineExaminations = $latestUrineExamQuery->get();


            $latestMotionExamQuery = DB::table('patient_motion_examination as pme');
            $latestMotionExamQuery->join('patient_motion_examination_item as pmei', 'pmei.patient_motion_examination_id', '=', 'pme.id');
            $latestMotionExamQuery->join('motion_examination as me', 'me.id', '=', 'pmei.motion_examination_id');
            $latestMotionExamQuery->where('pme.examination_date', '=', $date);

            $latestMotionExamQuery->where('pme.patient_id', '=', $patientId);
            $latestMotionExamQuery->where('pmei.is_value_set', '=', 1);

            $latestMotionExamQuery->select('pme.id as examinationId', 'pmei.id as examinationItemId',
                'pme.patient_id', 'me.examination_name', 'pme.examination_date', 'pmei.test_readings', 'pme.doctor_id', 'pme.fee_receipt_id');
            $latestMotionExaminations = $latestMotionExamQuery->get();


            $patientQuery = DB::table('patient as p')->select('p.id', 'p.patient_id', 'p.name', 'p.email', 'p.pid',
                'p.telephone', 'p.relationship', 'p.patient_spouse_name as spouseName', 'p.address', 'p.gender', 'p.age');
            $patientQuery->where('p.patient_id', '=', $patientId);
            $patientDetails = $patientQuery->first();

            $hospitalQuery = DB::table('hospital as h')->select('h.id', 'h.hospital_id', 'h.hospital_name', 'h.address', 'c.city_name',
                'co.name');
            $hospitalQuery->join('cities as c', 'c.id', '=', 'h.city');
            $hospitalQuery->join('countries as co', 'co.id', '=', 'h.country');
            $hospitalQuery->where('h.hospital_id', '=', $hospitalId);
            $hospitalDetails = $hospitalQuery->first();

            $D = count($bloodExaminations) > 0 ? $bloodExaminations[0]->doctor_id: null;
            $U = count($latestUrineExaminations) > 0 ? $latestUrineExaminations[0]->doctor_id : null;
            $M = count($latestMotionExaminations) > 0 ? $latestMotionExaminations[0]->doctor_id : null;


            $DID = count($bloodExaminations) > 0 ? $bloodExaminations[0]->fee_receipt_id : null;
            $UID = count($latestUrineExaminations) > 0 ? $latestUrineExaminations[0]->fee_receipt_id : null;
            $MID = count($latestMotionExaminations) > 0 ? $latestMotionExaminations[0]->fee_receipt_id : null;

            $receiptID = null;
            if ($DID != null) $receiptID = $DID;
            if ($UID != null) $receiptID = $UID;
            if ($MID != null) $receiptID = $MID;


            $doctor_id = null;
            if ($D != null) $doctor_id = $D;
            if ($U != null) $doctor_id = $U;
            if ($M != null) $doctor_id = $M;
            if ($doctor_id != null) {
                $doctorinfo = Doctor::find($doctor_id);

                //  dd($doctorinfo);
            }
            $receiptStatus = "notpaid";
            if ($receiptID != null) {
                $LabDetails = LabFeeReceipt::find($receiptID);

                $receiptStatus = (($LabDetails->total_fees - $LabDetails->paid_amount) == 0) ? "paid" : "notpaid";


                // dd($doctorinfo);
            }

            // dd($doctorinfo);

            $examinationDates['recieptId'] = $receiptID;
            $examinationDates['recieptStatus'] = $receiptStatus;
            $examinationDates['patientDetails'] = $patientDetails;
            $examinationDates['recentBloodTests'] = $bloodExaminations;
            $examinationDates['hospitalDetails'] = $hospitalDetails;
            $examinationDates['recentUrineExaminations'] = $latestUrineExaminations;
            $examinationDates['recentMotionExaminations'] = $latestMotionExaminations;
            $examinationDates['doctorDetails'] = $doctorinfo;


            //dd($examinationDates);

        } catch (QueryException $queryEx) {
            //dd($queryEx);
            throw new HospitalException(null, ErrorEnum::PATIENT_EXAMINATION_DATES_ERROR, $queryEx);
        } catch (UserNotFoundException $userExc) {
            //dd($userExc);
            throw new HospitalException(null, $userExc->getUserErrorCode(), $userExc);
        } catch (Exception $exc) {
            //dd($exc);
            throw new HospitalException(null, ErrorEnum::PATIENT_EXAMINATION_DATES_ERROR, $exc);
        }

       // dd($examinationDates);
        return $examinationDates;
    }


}