<?php

namespace App\Http\Controllers\Pharma;

use App\Http\Controllers\Controller;
use App\patientportal\modal\Hospital;
use App\patientportal\modal\HospitalPharmacy;
use App\patientportal\modal\Patient;
use App\patientportal\modal\PharmacyAppointment;
use App\patientportal\modal\Sms;
use App\patientportal\model\PharmacyAppointmentDocuments;
use App\patientportal\services\PharmaService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PharmaController extends Controller {

    /**
     * Where to redirect users after login.
     *
     * @var string

     */
    protected $pharmaService;

    public function __construct(PharmaService $pharmaService)
    {
        //   dd('Inside constructor');
        $this->pharmaService = $pharmaService;
    }


    public function getAppointment(Request $request){
        $appointment=null;
        try{
            $appointment=$this->pharmaService->getAppointment($request);
        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);
        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
        }
        return $appointment;
    }
    public function LoadPharmacy(Request $request){
        if (session('userID') && time() - session('logintime') < 900) {
            $hospital_id = $request->input("hospital_id");
            //$hospitals= App\HospitalDoctor ::where('doctor_id','=',$doctor_id)->select('hospital_id')->get()->toArray();
            $pharmacy = HospitalPharmacy::where('hospital_id', '=', $hospital_id)->join('pharmacy', 'pharmacy.pharmacy_id', '=', 'hospital_pharmacy.pharmacy_id')->get();
            return $pharmacy;
        } else {
            $hospitals = Hospital::all();
            return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');
        }

    }




    public function savePharmaAppointment(Request $request) {
        $status=null;

        try{

            $status=$this->pharmaService->saveAppointment($request);

        } catch (Exception $userExc) {
            $errorMsg = $userExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);

        }

        return redirect()->back()->with('msg', 'Your Pharmacy Appointment was Booked Successfully !');
    }

}
