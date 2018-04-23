<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22/04/2018
 * Time: 3:21 PM
 */

namespace App\patientportal\repositories\repoimpl;


use App\patientportal\repositories\repointerface\UserProfileInterface;
use App\User;

class UserProfileImpl implements UserProfileInterface
{
    public function getUsers()
    {
        //dd('Inside user implementation');
        return User::all();
    }
}