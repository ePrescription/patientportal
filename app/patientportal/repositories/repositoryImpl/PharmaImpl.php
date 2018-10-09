<?php
/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/30/18
 * Time: 4:30 PM
 */

namespace App\patientportal\repositories\repositoryImpl;
use App\patientportal\modal\HospitalPharmacy;
use App\patientportal\modal\PharmacyAppointment;
use App\patientportal\model\PharmacyAppointmentDocuments;
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
    public function saveAppointment($request){

        $fileType="";
        $OrgfileName="";
        $hospital_id = $request->get("hospital_id");
        $pharmacy_id = $request->get("pharmacy_id");
        $briefnote = $request->get("briefnote");
        $doctorname = $request->get("doctorname");
        $date = $request->get("date");
        $patient_id = session('patient_id');
        //dd($request->all());
        $Pharmacy = new PharmacyAppointment();

        $path = '';

        $Pharmacy->patient_id = $patient_id;
        $Pharmacy->hospital_id = $hospital_id;
        $Pharmacy->pharmacy_id = $pharmacy_id;
        $Pharmacy->doctor_name = $doctorname;
        //$Pharmacy->filepath = $path;
        $Pharmacy->brief_notes = $briefnote;
        //  $Pharmacy->filepath = $path;
        $Pharmacy->pickup_date = date('Y-m-d H:i:s', strtotime($date));
        // $Pharmacy->appointment_type = 1;
        //$Pharmacy->name=$doctorname;
        $Pharmacy->created_by = 'Admin';
        $Pharmacy->updated_by = 'Admin';
        $Pharmacy->save();

        if ($request->hasFile('image')) {
            //method one to stor file in disc
            // $path = Askquestion::putFile('storage', $request->file('image'));
            //method two to stor file in disc

            $files = $request->file('image');
            foreach ($files as $file) {
                $fileType= $file->getClientOriginalExtension();
                $OrgfileName=$file->getClientOriginalName();
                $filename = $patient_id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $path . $filename . "@@";
                //   $file->move('public/storage',$filename);
                $destinationPath='public/pharmacy';
                //Storage::putFileAs('public/pharmacy', $file, $filename);
                $file->move($destinationPath, $filename);

            }
            $pharmacyDocuments=new PharmacyAppointmentDocuments();
            $pharmacyDocuments->pharmacy_pickup_id=$Pharmacy->id;
            $pharmacyDocuments->document_path=$path;
            $pharmacyDocuments->document_filename=$OrgfileName;
            $pharmacyDocuments->document_extension=$fileType;
            $pharmacyDocuments->document_upload_status="1";
            $pharmacyDocuments->created_by = 'Admin';
            $pharmacyDocuments->updated_by = 'Admin';
            //$AskQuestionDocumentItems->patient_ask_question_id="";
            $pharmacyDocuments->save();

            // ensure every image has a different name
            // save new image $file_name to database
            // $model->update(['image' => $file_name]);
        }





        //    $dc = App\Doctor::where('doctor_id', '=', $doctor1)->get();
        $pharmacyinfo = HospitalPharmacy::where('hospital_id', '=', $hospital_id)->join('pharmacy', 'pharmacy.pharmacy_id', '=', 'hospital_pharmacy.pharmacy_id')->get();

        $id = $Pharmacy->id;
        $pharmacyappointments =DB::table('pharmacy_pickup as pup')
            ->join('pharmacy', 'pharmacy.pharmacy_id', '=', 'pup.pharmacy_id')
            ->join('pharmacy_pickup_documents as pupd','pupd.pharmacy_pickup_id','=','pup.id')
            ->join('hospital', 'hospital.hospital_id', '=', 'pup.hospital_id')
            ->where('pup.patient_id', '=', session('patient_id'))
            ->where('pup.id', '=', $id)
            ->select('pup.pickup_date as appointment_date','pupd.document_path as reports','pup.doctor_name', 'pup.id', 'pharmacy.address as pharmacyaddress', 'pharmacy.name as pharmacy', 'pup.brief_notes as brief_history', 'hospital.hospital_name', 'hospital.email', 'hospital.address as hsaddress', 'hospital.telephone')->get();

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
            $patient=Patient::where('patient_id', '=', session('patient_id'))->get();
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


      return true;
    }





}
