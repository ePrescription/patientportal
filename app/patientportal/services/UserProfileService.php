<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 23/04/2018
 * Time: 12:55 PM
 */

namespace App\patientportal\services;


use App\patientportal\repositories\repointerface\UserProfileInterface;
use App\patientportal\repository\repoInterface\UserInterface;
use App\patientportal\utilities\ErrorEnum\ErrorEnum;
use App\patientportal\utilities\Exception\UserProfileException;
use Exception;
use Illuminate\Support\Facades\DB;

class UserProfileService
{
    protected $userRepo;

    public function __construct(UserInterface $userRepo)
    {
        //dd('Inside constructor');
        $this->userRepo = $userRepo;
    }

    public function getUsers()
    {
        $users = null;
        //dd('Inside service in get users through facade');

        try
        {
            $users = $this->userRepo->getUsers();
        }
        catch(UserProfileException $profileExc)
        {
            throw $profileExc;
        }
        catch(Exception $exc)
        {
            throw new UserProfileException(null, ErrorEnum::USER_NOT_FOUND, $exc);
        }

        return $users;
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
}