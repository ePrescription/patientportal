<?php

namespace App\Http\Controllers;

use App\patientportal\modal\Hospital;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Exception;

use App\patientportal\common\ResponsePrescription;
use App\patientportal\utilities\ErrorEnum\ErrorEnum;

use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    public function authenticateUser(Request $request)
    {
        $email=$request->Email;
        $pass=$request->Password;
        try {
            $hash1 = bcrypt($email);
            $hash2 = bcrypt($email);
           $use=User::first()->take(1)->where('email',$email)->where('password',$pass)->get();
           if(count($use)>0) {
               $mail = $request->get("Email");
               $pass = $request->get("Password");

                   session(['userID' => $use[0]['name']]);
                   session(['patient_id' => $use[0]['id']]);
                   session(['email' => $request->Email]);
                   session(['logintime' => time()]);
                   session(['methode' => 'Doctor']);
                   $hospitals=Hospital::all();
                  // dd($use[0]['name']);

                   return redirect()->intended('index')->with('hospitals',$hospitals);

           }else{
               $hospitals=Hospital::all();
               return redirect()->intended('login')->with('hospitals',$hospitals)->with('msg','invalid login details');
           }

        }
        catch (JWTException $e) {
            dd($e);
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        catch(Exception $ex)
        {
            dd($ex);
            return response()->json(['error' => 'could_not_create_token'], 500);
        }


    }

    public function generateToken()
    {
        return csrf_token();
    }
}
