<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

   // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function login1(\Illuminate\Http\Request $request)
    {

         //dd();

        $mail = $request->get("Email");
        $pass = $request->get("Password");
       //dd(bcrypt($pass));
        $use= User::Validator($mail,$pass);
      dd($use);
        //dd(Auth::attempt(['email' => $request->get("Email"), 'password' => $request->get("Password")]));

            if (!empty($use[0]) && $use[0]['email']!="" ){
                //Auth::attempt(['email' => $email, 'password' => $pass])) {

                // Authentication passed...
                //login logic
                session(['userID' => $use[0]['name']]);
                session(['patient_id' => $use[0]['id']]);
                session(['email' => $mail]);
                session(['logintime' => time()]);
                session(['methode' => 'Doctor']);

                //parent::login($request);
                $hospitals=App\patientportal\modal\Hospital::all();

                return redirect()->intended('index')->with('hospitals',$hospitals);;
           // $LoginUserId=Session::put('LoginUserId', Auth::user()['id']);
           // dd($LoginUserId);
               // session(['userID' => Auth::user()['name']]);
                //session(['patient_id' => Auth::user()['id']]);
               // session(['email' => $mail]);
                //session(['logintime' => time()]);
               // session(['methode' => 'Doctor']);
               // dd(Session::get('userID'));

           //     //parent::login($request);
            //    $hospitals = App\patientportal\modal\Hospital::all();

                return redirect()->intended('index')->with('hospitals', $hospitals);
                //return view('index');

            /**
             * Create a new controller instance.
             *
             * @return void
             */
        }else{
            return redirect()->back();

        }

    }
}
