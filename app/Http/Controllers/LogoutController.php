<?php
namespace App\Http\Controllers;
use App\patientportal\modal\Hospital;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Session;
class LogoutController extends Controller
{
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Session::flush();
        $hospitals=Hospital::all();
        return view('welcome')->with('hospitals',$hospitals)->with('sessionmsg', 'Logout successfully');
       
    }
}