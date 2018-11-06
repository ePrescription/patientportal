<?php
/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/27/18
 * Time: 3:59 PM
 */

namespace App\patientportal\services;

//use App\patientportal\utilities\Exception\HospitalException;
use App\patientportal\repositories\repoInterface\UserInterface;
use App\patientportal\utilities\ErrorEnum\ErrorEnum;
use App\patientportal\utilities\Exception\HospitalException;
use Illuminate\Support\Facades\DB;


class UserService
{

    protected $userRepo;

    public function __construct(UserInterface $UserRepo)
    {
     //   dd('Inside constructor');
        $this->userRepo = $UserRepo;
    }


    public function registerPatientDetails($request)
    {
       // dd('Service');
        $status = null;
        try {

          //  dd('Service');
            $status = $this->userRepo->registerPatientDetails($request);

        } catch (\Mockery\Exceptionxception $exe) {

        }
        return $status;
    }
    public function otpconfirm($request)
    {
        // dd('Service');
        $status = null;
        try {

            //  dd('Service');
            $status = $this->userRepo->otpconfirm($request);

        } catch (\Mockery\Exceptionxception $exe) {

        }
        return $status;
    }

    public function savePatientProfile($patientProfileVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($patientProfileVM, &$status)
            {
                $status = $this->userRepo->saveNewPatientProfile($patientProfileVM);
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


    public function EditPatientProfile($patientProfileVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($patientProfileVM, &$status)
            {
                $status = $this->userRepo->EditPatientProfile($patientProfileVM);
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


}