<?php

namespace App\Http\Controllers\User;

use App\patientportal\facades\UserFacade;
use App\patientportal\services\UserProfileService;
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

    public function __construct(UserProfileService $userProfileService)
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
}
