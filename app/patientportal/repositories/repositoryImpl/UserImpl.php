<?php

namespace App\patientportal\repositories\repositoryImpl;

use App\Http\ViewModels\PatientProfileViewModel;
use App\patientportal\modal\RoleUser;
use App\patientportal\modal\HospitalPatient;
use App\patientportal\modal\Patient;
use App\patientportal\modal\Role;
use App\User;
use App\patientportal\repositories\repoInterface\UserInterface;
use App\patientportal\utilities\ErrorEnum\ErrorEnum;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;


/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/27/18
 * Time: 4:21 PM
 */
class UserImpl implements UserInterface
{


    public function registerPatientDetails($request)
    {
        // dd('ServiceIMPL');
        $otp = null;
        try {
            $val = $request->all();
            //  $delete_status=$val['delete_status']=1;
            $name = $val['name'];
            $email = $val['email'];
            $password = $val['password'];
            $telephone = $val['telephone'];
            $hospital_id = $val['hospital_id'];
            $age = $val['age'];
            $create_by = 'admin';
            $updated_by = 'admin';
            //$user = new User;
            $user = new User();
            $otp = rand(10000, 99999);

            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->confirmation_code = $otp;
            $user->confirmed = 0;
            $user->delete_status = 1;

            $user->save();
//  $id=$user->id;

            //  $user=DB::table('users')->insert(['name'=>$name,'email'=>$email,'password'=>$password,'delete_status'=>1]);
            $insertedId = $user->id;
            $patient = new Patient();
            $patient->name = $name;
            $patient->patient_id = $insertedId;
            $patient->pid = $insertedId;

            $patient->email = $email;
            $patient->telephone = $telephone;
            $patient->age = $age;
            $patient->payment_status=0;
            $patient->created_by = $create_by;
            $patient->updated_by = $updated_by;
            $patient->save();

            $hospital_patient = new HospitalPatient();
            // $hospital_patient_latest = DB::table('hospital_patient')->count();
            // dd($hospital_patient_latest);

            $hospital_patient->patient_id = $insertedId;
            $hospital_patient->hospital_id = $hospital_id;
            $hospital_patient->created_by = $create_by;
            $hospital_patient->updated_by = $updated_by;
            $hospital_patient->save();


            Mail::raw('Your one time Password is: ' . $otp, function ($msg) use ($email) {
                $msg->subject('Your OTP');
                $msg->from('prasanth@glovision.co');
                $msg->to($email);
            });

            session(['patient_id' => $insertedId]);
        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            error_log($otp);
            //$msg->sendUnExpectedExpectionResponse($exc);
        }


        return $otp;
    }

    public function otpconfirm($request)
    {
        $status = null;
        try {
            $otp = $request->input('otp');
            $id = session('patient_id');
            // $user=session('userID');
            $user =User::find($id);
            // return $user['confirmation_code'];
            if ($otp == $user['confirmation_code']) {
                session(['userID' => $user['name']]);
                session(['patient_id' => $user]);
                session(['email' => $user['email']]);

                session(['logintime' => time()]);
                // return $user;
                // $hospitals = Hospital::all();
                // return view('index')->with('hospitals', $hospitals);
                $status = 1;
            } else {
                $status = 0;
            }
            //  return view('otp', ['msg' => 'Enter Valid otp']); //  view('askquestion')->with('specialty', $specialty);
        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            error_log($status);
            //$msg->sendUnExpectedExpectionResponse($exc);
        }
        return $status;


    }
    public function saveNewPatientProfile(PatientProfileViewModel $patientProfileVM)
    {
        $status = true;
        $user = null;
        $patientId = null;
        $patient = null;
        $hospitalPatient = null;
        $hospitalId = null;
        $msg=null;
//dd($patientProfileVM);
        try {
            $patientId = $patientProfileVM->getPatientId();
            $hospitalId = $patientProfileVM->getHospitalId();
         // dd($hospitalId);

            if ($patientId == 0) {
                $user = $this->registerNewPatient($patientProfileVM);
               // $this->attachPatientRole($user);
               // $user = Role::find(UserType::USERTYPE_PATIENT);
                $patient = new Patient();
            } else {
               // dd('TETS');
                $patient = Patient::where('patient_id', '=', $patientId)->first();
                //dd($patient);
                if (!is_null($patient)) {
                    //$user = User::find($companyId);
                    $user = $this->registerNewPatient($patientProfileVM);
                }
            }
          // dd($user->id);


            $insertedId = $user->id;
            $patient->patient_id = $user->id;
            $patient->name = $patientProfileVM->getName();
            $patient->address = $patientProfileVM->getAddress();
            $patient->city = $patientProfileVM->getCity();
            $patient->country = $patientProfileVM->getCountry();
            $pid = $this->generateRandomString();
            $patient->pid = 'PID' . $pid;

            $patient->telephone = $patientProfileVM->getTelephone();
            $patient->email = $patientProfileVM->getEmail();
            $patient->patient_photo = $patientProfileVM->getPatientPhoto();
            $patient->dob = $patientProfileVM->getDob();
            $patient->age = $patientProfileVM->getPlaceOfBirth();
            $patient->nationality = $patientProfileVM->getNationality();
            $patient->gender = $patientProfileVM->getGender();
            $patient->married = $patientProfileVM->getMaritalStatus();
            $patient->payment_status = 0;


            $patient->created_by = $patientProfileVM->getCreatedBy();
            $patient->created_at = $patientProfileVM->getCreatedAt();
            $patient->updated_by = $patientProfileVM->getUpdatedBy();
            $patient->updated_at = $patientProfileVM->getUpdatedAt();

            $user=$patient->save();

            $roleUser=new RoleUser();
            $roleUser->user_id=$insertedId;
            $roleUser->role_id=4;
            $roleUser->save();
            $hospitalPatient=new HospitalPatient();
            $hospitalPatient->patient_id=$insertedId;
            $hospitalPatient->hospital_id=$hospitalId;
            $hospitalPatient->created_by = $patientProfileVM->getCreatedBy();
            $hospitalPatient->created_at = $patientProfileVM->getCreatedAt();
            $hospitalPatient->updated_by = $patientProfileVM->getUpdatedBy();
            $hospitalPatient->updated_at = $patientProfileVM->getUpdatedAt();

            $hospitalPatient->save();

            session(['patient_id' => $insertedId]);


           // $user->patienthospitals()->attach($hospitalId, array('created_by' => $patientProfileVM->getCreatedBy(),
               // 'updated_by' => $patientProfileVM->getUpdatedBy()));
        } catch (QueryException $queryEx) {
            //dd($queryEx);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_PROFILE_SAVE_ERROR, $queryEx);
        } catch (Exception $exc) {
            //dd($exc);
            $status = false;
            throw new HospitalException(null, ErrorEnum::PATIENT_PROFILE_SAVE_ERROR, $exc);
        }

        return $status;
    }

    private function registerNewPatient(PatientProfileViewModel $patientProfileVM)
    {
        $user = null;
        $patientId = $patientProfileVM->getPatientId();

        if ($patientId == 0) {
            $user = new User();
        } else {
            $user = User::find($patientId);
        }
        $otp = rand(10000, 99999);

        $email=$patientProfileVM->getEmail();

        Mail::raw('Your one time Password is: ' . $otp, function ($msg) use ($email) {
            $msg->subject('Your OTP');
            $msg->from('prasanth@glovision.co');
            $msg->to($email);
        });


        $user->name = $patientProfileVM->getName();
        $user->email = $patientProfileVM->getEmail();
        $user->password =$patientProfileVM->getPassword();
        $user->delete_status = 1;
        $user->confirmation_code = $otp;
        $user->confirmed = 0;

        $user->created_at = $patientProfileVM->getCreatedAt();
        $user->updated_at = $patientProfileVM->getUpdatedAt();

        $user->save();

        return $user;
    }

    private function attachPatientRole(User $user)
    {
        $role = Role::find(4);


        if (!is_null($role)) {
           // dd($role);
            $user->attachRole($role);
        }
    }
    private function generateRandomString($length = 9) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}





