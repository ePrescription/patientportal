<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22/04/2018
 * Time: 3:15 PM
 */

namespace App\patientportal\facades;


use Illuminate\Support\Facades\Facade;

class UserFacade extends Facade
{
    protected static function getFacadeAccessor() {
        //dd('Inside facade');
        return 'UserService';
    }
}