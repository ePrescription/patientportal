<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\PatientProfileRequest;
use App\patientportal\common\ResponsePrescription;
use App\patientportal\facades\UserFacade;
use App\patientportal\mapper\PatientProfileMapper;
use App\patientportal\modal\Hospital;
use App\patientportal\services\UserProfileService;
use App\patientportal\services\UserService;
use App\patientportal\utilities\ErrorEnum\ErrorEnum;
use App\patientportal\utilities\Exception\UserProfileException;
use App\patientportal\Utilities\Logger\PrescriptionLog;
use Exception;
use App\patientportal\utilities\Exception\AppendMessage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userProfileService)
    {
        $this->userService = $userProfileService;
    }

    public function getUsers()
    {
        //dd('Inside Controller in get users');
        $users = null;
        $responseJson = null;

        try
        {
            //$users = $this->userService->getUsers();
            $users = UserFacade::getUsers();

        }
        catch(UserProfileException $profileExc)
        {
            $errorMsg = PrescriptionLog::WritePrescriptionExceptionToLog($profileExc);
            //return redirect('exception')->with('message', $errorMsg . " " . trans('messages.SupportTeam'));
        }
        catch(Exception $exc)
        {
            PrescriptionLog::WriteGeneralExceptionToLog($exc);
            //return redirect('exception')->with('message', trans('messages.SupportTeam'));
        }

        //return $responseJson;
    }
    public function welcome()
    {

        $hospitals = Hospital::all();
        dd($hospitals);

        return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');
    }


    public function registerPatient(Request $request)
    {
        //dd($request);
        $otp = 1;
        try {
            //  dd($request);
            $otp = $this->userService->registerPatientDetails($request);


        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
            //$msg->sendUnExpectedExpectionResponse($exc);
        }

        $msg = 'Enter otp';
        return view('otp', compact('msg', 'otp'));

    }

    public function otpConfirm(Request $request)
    {

        try {
            //  dd($request);
            $otp = $this->userService->otpconfirm($request);
            //dd($otp);
            if ($otp) {
                $hospitals = Hospital::all();
                return view('index')->with('hospitals', $hospitals);
            } else {
                $msg = 'Enter Correct Otp';
                return view('otp', compact('msg', 'otp'));
            }


        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
            //$msg->sendUnExpectedExpectionResponse($exc);
        }

    }
    public function saveNewPatientProfile(PatientProfileRequest $patientProfileRequest)
    {
        //return "HI";
        $patientProfileVM = null;
        $status = true;
        $responseJson = null;
        //dd($patientProfileRequest);

        try
        {
            $patientProfileVM = PatientProfileMapper::setNewPatientProfile($patientProfileRequest);
            $status = $this->userService->savePatientProfile($patientProfileVM);

            //$status = HospitalServiceFacade::savePatientProfile($patientProfileVM);
            //$patient = HospitalServiceFacade::savePatientProfile($patientProfileVM);

            if($status)
            {
                //$jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::PATIENT_PROFILE_SAVE_SUCCESS));
                $responseJson = new ResponsePrescription(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::PATIENT_PROFILE_SAVE_SUCCESS));
                $responseJson->sendSuccessResponse();
            }
            else
            {
                $responseJson = new ResponsePrescription(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::PATIENT_PROFILE_SAVE_ERROR));
                $responseJson->sendSuccessResponse();
            }

        }
        catch(HospitalException $hospitalExc)
        {
            //dd($hospitalExc);
            $responseJson = new ResponsePrescription(ErrorEnum::FAILURE, trans('messages.'.$hospitalExc->getUserErrorCode()));
            $responseJson->sendErrorResponse($hospitalExc);
        }
            /*catch(UserNotFoundException $userExc)
            {
                $responseJson = new ResponsePrescription(ErrorEnum::FAILURE, trans('messages.'.$userExc->getUserErrorCode()));
                $responseJson->sendErrorResponse($userExc);
            }*/
        catch(Exception $exc)
        {
            //dd($exc);
            $responseJson = new ResponsePrescription(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::PATIENT_PROFILE_SAVE_ERROR));
            $responseJson->sendUnExpectedExpectionResponse($exc);
        }

        //   return $responseJson;
        $msg = 'Enter otp';
        return view('otp', compact('msg', 'otp'));
    }


}
