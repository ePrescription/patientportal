<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 23/04/2018
 * Time: 12:55 PM
 */

namespace App\patientportal\services;


use App\patientportal\repositories\repointerface\UserProfileInterface;
use App\patientportal\utilities\ErrorEnum\ErrorEnum;
use App\patientportal\utilities\Exception\UserProfileException;
use Exception;

class UserProfileService
{
    protected $userRepo;

    public function __construct(UserProfileInterface $userRepo)
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
}