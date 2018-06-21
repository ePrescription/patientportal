<?php
/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/30/18
 * Time: 4:30 PM
 */

namespace App\patientportal\repositories\repositoryImpl;
use App\patientportal\repositories\repoInterface\LabInterface;

use App\patientportal\modal\Doctor;
use App\patientportal\modal\DoctorAppointment;
use App\patientportal\modal\Hospital;
use App\patientportal\modal\LabLabtest;
use App\patientportal\modal\Labtest;
use App\patientportal\modal\Patient;
use App\patientportal\modal\Sms;
use App\patientportal\repositories\repoInterface\PharmaInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/30/18
 * Time: 4:31 PM
 */
class PharmaImpl implements PharmaInterface
{

    public function getAppointment($request)
    {
        try {

            session(['methode' => $request->input('methode')]);
            $specialty = Doctor::select('specialty')->distinct()->get();
            //return $specialty;
            $typeoftest =Labtest::select('test_category')->distinct()->get();
            $hospitals = Hospital::all();
        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }

        return view('pharmacies')->with('specialty', $specialty)->with('typeoftest', $typeoftest)->with('hospitals', $hospitals);


    }
}
