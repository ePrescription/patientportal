<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientProfileRequest;
use App\patientportal\mapper\PatientProfileMapper;
use Illuminate\Http\Request;
use App\patientportal\services\UserService;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegisterPatientController
 *
 * @author Glodeveloper
 */
class RegisterPatientController extends Controller
{
    protected $UserService;

    public function __construct(UserService $UserService)
    {
        //dd('Inside constructor');
        $this->UserService = $UserService;
    }

    public function welcome(){

        $hospitals =Hospital::all();
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

