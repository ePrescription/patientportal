<?php

namespace App\Http\Controllers\Pharma;

use App\Http\Controllers\Controller;
use App\patientportal\modal\HospitalPharmacy;
use App\patientportal\modal\PharmacyAppointment;
use App\patientportal\modal\Sms;
use App\patientportal\services\PharmaService;
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
            //error_log($status);
        }
        return $appointment;
    }

    public function save(\Illuminate\Http\Request $request) {
        $hospital_id = $request->get("hospital_id");
        $pharmacy_id = $request->get("pharmacy_id");
        $briefnote = $request->get("briefnote");
         $doctorname = $request->get("doctorname");
        $date = $request->get("date");
        $patient_id = session('patient_id');
        $Pharmacy = new PharmacyAppointment();

        $path = '';
        $nooffiles = 0;

        if ($request->hasFile('image')) {
            //method one to stor file in disc
            // $path = Askquestion::putFile('storage', $request->file('image'));
            //method two to stor file in disc

            $files = $request->file('image');
            foreach ($files as $file) {
                $filename = $patient_id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $path . $filename . "@@";
                //   $file->move('public/storage',$filename);

                Storage::putFileAs('public/pharmacy', $file, $filename);
            }

            // ensure every image has a different name
            // save new image $file_name to database
            // $model->update(['image' => $file_name]);
        }


        $Pharmacy->patient_id = $patient_id;
        // $askquestion->specialist_id = $specialist;
        //$Pharmacy->doctor_id = $doctor1;
        $Pharmacy->hospital_id = $hospital_id;
        $Pharmacy->pharmacy_id = $pharmacy_id;
        $Pharmacy->filepath = $path;
        $Pharmacy->briefnote = $briefnote;
        //  $Pharmacy->filepath = $path;
        $Pharmacy->appointment_date = date('Y-m-d H:i:s', strtotime($date));
        //     $Pharmacy->appointment_date = $date;
        $Pharmacy->appointment_type = 1;
        //$Pharmacy->name=$doctorname;
        $Pharmacy->created_by = 'Admin';
        $Pharmacy->modified_by = 'Admin';
        $Pharmacy->save();


        //    $dc = App\Doctor::where('doctor_id', '=', $doctor1)->get();
        $pharmacyinfo = HospitalPharmacy::where('hospital_id', '=', $hospital_id)->join('pharmacy', 'pharmacy.pharmacy_id', '=', 'hospital_pharmacy.pharmacy_id')->get();

        $id = $Pharmacy->id;
        $pharmacyappointments =PharmacyAppointment::join('pharmacy', 'pharmacy.pharmacy_id', '=', 'pharmacy_appointment.pharmacy_id')->join('hospital', 'hospital.hospital_id', '=', 'pharmacy_appointment.hospital_id')->where('pharmacy_appointment.patient_id', '=', session('patient_id'))->where('pharmacy_appointment.id', '=', $id)->select('pharmacy_appointment.appointment_date','pharmacy_appointment.filepath as prescription', 'pharmacy_appointment.id', 'pharmacy.address as pharmacyaddress', 'pharmacy.name as pharmacy', 'pharmacy_appointment.briefnote as brief_history', 'hospital.hospital_name', 'hospital.email', 'hospital.address as hsaddress', 'hospital.telephone')->paginate(10);

        //  $mails=[session('email'),$pharmacyinfo[0]->email];

        $mails = array();
        if (session('email') != "") {
            $mails[count($mails)] = session('email');
        }
        if ($pharmacyinfo[0]->email != "") {
            $mails[count($mails)] = $pharmacyinfo[0]->email;
        }

        if (count($mails) > 0) {
            Mail::send('maillayout.pharmacy_appointment', ['doctorappointments' => $pharmacyappointments], function($msg) use($mails) {
                $msg->subject('Booking Pharmacy Appointment');
                $msg->from(session('email'));
                $msg->to($mails);
            });
        }
        
          $mblno='';
            if(session('patient_id')!=""){
               $patient= \App\Patient::where('patient_id', '=', session('patient_id'))->get();
               if($patient[0]['telephone']!=""){
                   $mblno=$patient[0]['telephone'];
               }
            }
            if ($pharmacyappointments[0]->telephone != "") {
                $mblno =$mblno.",".$pharmacyappointments[0]->telephone;
            }
            if($mblno!=""){
                $msg="Patient ID:".session('patient_id');
                $msg=$msg."%0APatient Name:".session('userID');
                $msg=$msg."%0ADoctor Name:".$pharmacyappointments[0]->doctor_name;
              
                 $msg=$msg."%0ABrief Note:".$pharmacyappointments[0]->brief_history;
                $msg=$msg."%0ADOA:".$pharmacyappointments[0]->appointment_date;
                Sms::sendMSG($mblno, $msg);
            }

        return redirect()->back()->with('msg', 'Your Pharmacy Appointment was Booked Successfully !');
    }

}
