<?php
use App\patientportal\modal\Doctor;
use App\patientportal\modal\Hospital;
use App\patientportal\modal\LabFeeReceipt;
use App\patientportal\modal\PharmacyAppointment;
use App\patientportal\modal\User;
use App\patientportal\utilities\ErrorEnum\ErrorEnum;
use App\patientportal\utilities\Exception\HospitalException;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/login', function () {
    $hospitals =  Hospital::all();

    return view('welcome')->with('hospitals', $hospitals);
});

Route::group(['prefix' => 'user'], function()
{
    Route::group(['namespace' => 'User'], function()
    {
        Route::get('rest/users', array('as' => 'user.users', 'uses' => 'UserController@getUsers'));
        //Route::get('rest/api/{patientId}/profile', array('as' => 'patient.profile', 'uses' => 'CommonController@getPatientProfile'));
    });

});
Route::get('/home111', function(){
    $hospitals =  App\Hospital::all();
    return view('home')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');;
});

//Route::get('/', array('as' => 'user.welcome', 'uses' => 'User\UserController@welcome'));
//Route::post('/dologin', array('as' => 'user.dologin', 'uses' => 'Doctor\DoctorController@userlogin'));

//var_dump(Route::post('/register', array('as' => 'user.register', 'uses' => 'User\RegisterPatientController@registerPatient')));
Route::post('/register', array('as' => 'user.register', 'uses' => 'User\UserController@saveNewPatientProfile'));
Route::post('/otpconfirm', array('as' => 'user.otpconfirm', 'uses' => 'User\UserController@otpconfirm'));




/* authetication login routes */

Route::post('login', 'AuthenticateController@AuthenticateUser');

Route::get('/login1', function () {
    $hospitals = App\Hospital::all();
    return view('index')->with('hospitals', $hospitals);
});

Route::get('/logout', 'LogoutController@logout');

/* welcome file route*/
Route::get('/', function () {
    $hospitals =  App\patientportal\modal\Hospital::all();
    // dd($hospitals);
    return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', '');
});


Route::get('/index', function () {
    if (session('userID') && time() - session('logintime') < 900) {

        $hospitals = App\patientportal\modal\Hospital::all();
        return view('index')->with('hospitals', $hospitals);
    } else {
        $hospitals = App\patientportal\modal\Hospital::all();
        return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');
    }
});

/*Doctor Section Start*/

Route::get('appointment',array('as' => 'doctor.getappointment', 'uses' => 'Doctor\DoctorController@getAppointment'));

Route::get('loaddoctor', array('as' => 'doctor.loaddoctors', 'uses' => 'Doctor\DoctorController@getDoctors'));
Route::get('loadhospitals', array('as' => 'doctor.loadhospitals', 'uses' => 'Doctor\DoctorController@getHospitals'));
Route::get('loadAddress', array('as' => 'doctor.loadAddress', 'uses' => 'Doctor\DoctorController@getAddress'));
Route::get('loadAddress', array('as' => 'doctor.loadAddress', 'uses' => 'Doctor\DoctorController@getAddress'));
Route::get('timeslots', array('as' => 'doctor.doctortimeslots', 'uses' => 'Doctor\DoctorController@getDoctorAvailability'));
Route::post('makeappointment',array('as' => 'doctor.doctorappointment', 'uses' => 'Doctor\DoctorController@BookDoctorAppointment'));
//Route::get('makeappointment','Doctor\DoctorController@BookDoctorAppointment');
//var_dump(Route::get('makeappointment','Doctor\DoctorController@BookDoctorAppointment'));
/*Doctor Section END*/

Route::get('rest/api/hospital/{hospitalId}/doctor/{doctorId}/date/{date}/tokenId', array('as' => 'patient.tokenid', 'uses' => 'Doctor\DoctorController@getTokenIdByHospitalIdandDoctorId'));
Route::get('rest/api/appointmenttimes', array('as' => 'hospital.appointmenttimes', 'uses' => 'Doctor\DoctorController@getAppointmentTimes'));





/* LAB Section Start */

Route::get('labappointment',array('as' => 'lab.getappointment', 'uses' => 'Lab\LabController@getAppointment'));

Route::get('loadsubtest',array('as' => 'lab.loadsubtests', 'uses' => 'Lab\LabController@loadSubTests'));

Route::get('loadlabs',array('as' => 'lab.loadlabs', 'uses' => 'Lab\LabController@loadLabs'));
Route::get('bloodtestsentries',array('as' => 'lab.loadbloodtestsentries', 'uses' => 'Lab\LabController@getBloodTestsEntries'));
Route::get('motiontestsentries',array('as' => 'lab.loadmotiontestsentries', 'uses' => 'Lab\LabController@getMotionTestsEntries'));
Route::get('ultrasoundtestsentries',array('as' => 'lab.loadultrasoundtestsentries', 'uses' => 'Lab\LabController@getUltrasoundTestsEntries'));
Route::get('scantestsentries',array('as' => 'lab.loadscantestsentries', 'uses' => 'Lab\LabController@getScanTestsEntries'));
Route::get('dentaltestsentries',array('as' => 'lab.loaddentaltestsentries', 'uses' => 'Lab\LabController@getDentalTestsEntries'));
Route::get('xraytestsentries',array('as' => 'lab.loadxraytestsentries', 'uses' => 'Lab\LabController@getXrayTestsEntries'));
Route::get('urinetestsentries',array('as' => 'lab.loadurinetestsentries', 'uses' => 'Lab\LabController@getUrineTestsEntries'));

Route::post('lab/rest/patient/bloodtestresults', array('as' => 'patient.bloodtestresults', 'uses' => 'Lab\LabController@savePatientBloodTests'));
Route::post('lab/rest/patient/dentaltestresults', array('as' => 'patient.dentaltestresults', 'uses' => 'Lab\LabController@savePatientDentalTests'));
Route::post('lab/rest/patient/motiontestresults', array('as' => 'patient.motiontestresults', 'uses' => 'Lab\LabController@savePatientMotionTests'));
Route::post('lab/rest/patient/urinetestresults', array('as' => 'patient.urinetestresults', 'uses' => 'Lab\LabController@savePatientUrineTests'));
Route::post('lab/rest/patient/ultrasoundtestresults', array('as' => 'patient.ultrasoundtestresults', 'uses' => 'Lab\LabController@savePatientUltrasoundTests'));
Route::post('lab/rest/patient/scantestresults', array('as' => 'patient.scantestresults', 'uses' => 'Lab\LabController@savePatientScanDetails'));
Route::post('lab/rest/patient/xraytestresults', array('as' => 'patient.xraytestresults', 'uses' => 'Lab\LabController@savePatientXrayTests'));

Route::get('loaddoctorlab', array('as' => 'lab.loaddoctorforlab', 'uses' => 'Lab\LabController@loaddoctorLab'));

Route::get('rest/api/{hospitalId}/patient/{patientId}/lab-details-results', array('as' => 'hospital.patientlabReportsresults', 'uses' => 'Lab\LabController@PatientLabDetailsResultsByHospitalForFront'));
Route::get('rest/api/hospital/{hospitalId}/patient/{patientId}/{date}/lab-reports', array('as' => 'hospital.patientlabreports', 'uses' => 'Lab\LabController@PatientLabReportsByHospitalForDoctor'));


Route::get('pharmaciesappointment',array('as' => 'pharma.getappointment', 'uses' => 'Pharma\PharmaController@getAppointment'));



Route::get('/lab_appointmentmsg/patientId/{patientId}/hospitalId/{hospitalId}/date/{date}', array('as' => 'lab.labresult', 'uses' => 'Lab\LabController@PatientLabReportsByHospitalForDoctor'));

/* book appointment route */
Route::get('/history', array('as' => 'user.history', 'uses' => 'Doctor\DoctorController@getHistory'));
Route::get('/askquest', array('as' => 'user.askquestion', 'uses' => 'Doctor\DoctorController@AskQuestionPage'));
//Route::post('/askquestsendmail', 'AskquestionController@sendmail');
Route::post('/askquestsendmail', array('as' => 'user.saveaskquestion', 'uses' => 'Doctor\DoctorController@saveQuestion'));

Route::get('/singledoctor', array('as' => 'user.saveaskquestion', 'uses' => 'Doctor\DoctorController@SingleDoctor'));

Route::get('/secondoption', array('as' => 'user.secondopinion', 'uses' => 'Doctor\DoctorController@SecondOptionPage'));
Route::post('/Savesecondopinion', array('as' => 'user.secondopinion', 'uses' => 'Doctor\DoctorController@saveSecondOpinion'));

Route::get('/doctors', array('as' => 'user.askquestion', 'uses' => 'Doctor\DoctorController@DoctorsPage'));

Route::get('/loaddoctorslist', array('as' => 'user.doctorlist', 'uses' => 'Doctor\DoctorController@DoctorsList'));

Route::get('/ask_appointmentmsg', array('as' => 'user.doctorlist', 'uses' => 'Doctor\DoctorController@AskMsgLayout'));

Route::get('hospital/{hospitalId}/HospitalDoctors', array('as' => 'user.doctorlist', 'uses' => 'Doctor\DoctorController@getHospitalDoctors'));


Route::get('/doctor_appointmentmsgnew',array('as' => 'user.doctorlist', 'uses' => 'Doctor\DoctorController@DoctorAppointmentLabel'));

Route::get('healthCheck', array('as' => 'doctor.getHealthCheckList', 'uses' => 'Doctor\DoctorController@HealthCheck'));

Route::post('/updateappointment', array('as' => 'doctor.getHealthCheckList', 'uses' => 'Doctor\DoctorController@update'));




Route::get("/loadappointmentdetails",function(\Illuminate\Http\Request $request){
    $id=$request->input("id");
    $doctorappointments =  App\patientportal\modal\DoctorAppointment::join('doctor', 'doctor.doctor_id', '=', 'doctor_appointment.doctor_id')->join('hospital', 'hospital.hospital_id', '=', 'doctor_appointment.hospital_id')->where('doctor_appointment.patient_id', '=', session('patient_id'))->where('doctor_appointment.id', '=',$id)->select('doctor_appointment.id', 'doctor_appointment.appointment_date', 'doctor_appointment.appointment_time as time', 'doctor.name','doctor.doctor_id', 'hospital.hospital_name','hospital.hospital_id','hospital.address','doctor_appointment.brief_history', 'doctor.specialty')->get();

    return $doctorappointments;
});



Route::get('/appointmentlabel', function(\Illuminate\Http\Request $request) {
    if (session('userID') && time() - session('logintime') < 900) {

        $id = $request->input("id");

        $doctorappointments =  App\patientportal\modal\DoctorAppointment::join('doctor', 'doctor.doctor_id', '=', 'doctor_appointment.doctor_id')->join('hospital', 'hospital.hospital_id', '=', 'doctor_appointment.hospital_id')->where('doctor_appointment.patient_id', '=', session('patient_id'))->where('doctor_appointment.id', '=', $id)->select('doctor.name', 'doctor.specialty', 'doctor_appointment.appointment_date','doctor_appointment.appointment_time as time', 'doctor_appointment.brief_history', 'hospital.hospital_name', 'hospital.email', 'hospital.address as hsaddress', 'hospital.telephone')->get();
        return view("maillayout.label")->with('doctorappointments', $doctorappointments);
    } else {
        $hospitals =  App\patientportal\modal\Hospital::all();
        return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');
    }
});



//Route::get('/lab_appointmentmsg', function(\Illuminate\Http\Request $request) {
//   if (session('userID') && time() - session('logintime') < 900) {

// }
//});


Route::get('/pharmacy_appointmentmsg', function(\Illuminate\Http\Request $request) {
    if (session('userID') && time() - session('logintime') < 900) {
        $id = $request->input("id");
        $pharmacyappointments = PharmacyAppointment::join('pharmacy', 'pharmacy.pharmacy_id', '=', 'pharmacy_appointment.pharmacy_id')->join('hospital', 'hospital.hospital_id', '=', 'pharmacy_appointment.hospital_id')->where('pharmacy_appointment.patient_id', '=', session('patient_id'))->where('pharmacy_appointment.id', '=', $id)->select('pharmacy_appointment.filepath as prescription', 'pharmacy_appointment.id', 'pharmacy.address as pharmacyaddress', 'pharmacy.name as pharmacy', 'pharmacy_appointment.appointment_date', 'pharmacy_appointment.briefnote as brief_history', 'hospital.hospital_name', 'hospital.email', 'hospital.address as hsaddress', 'hospital.telephone')->paginate(10);

        //$labappointments= \App\Labappointment::join('lab','lab.lab_id','=','lab_appointment.lab_id')->join('hospital','hospital.hospital_id','=','lab_appointment.hospital_id')->where('lab_appointment.patient_id','=',session('patient_id'))->select('lab_appointment.id','lab.address as labaddress','lab.name as lab','lab_appointment.appointment_date','lab_appointment.brief_history','hospital.hospital_name','hospital.email','hospital.address as hsaddress','hospital.telephone')->paginate(10);
        return view("maillayout.pharmacy_appointment")->with('doctorappointments', $pharmacyappointments);
    } else {
        $hospitals =  App\patientportal\modal\Hospital::all();
        return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');
    }
});






Route::post('/makelabappointment', 'LabappointmentController@insert');





Route::get("loadpharmacy", function(Illuminate\Http\Request $request) {
    if (session('userID') && time() - session('logintime') < 900) {
        $hospital_id = $request->input("hospital_id");
        //$hospitals= App\HospitalDoctor ::where('doctor_id','=',$doctor_id)->select('hospital_id')->get()->toArray();
        $pharmacy = App\patientportal\modal\HospitalPharmacy::where('hospital_id', '=', $hospital_id)->join('pharmacy', 'pharmacy.pharmacy_id', '=', 'hospital_pharmacy.pharmacy_id')->get();
        return $pharmacy;
    } else {
        $hospitals = App\patientportal\modal\Hospital::all();
        return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');
    }
});
Route::post('/makepharmacyappointment', 'Pharma\PharmaController@save');




Route::get("doctoravailability", function(Illuminate\Http\Request $request) {
    if (session('userID') && time() - session('logintime') < 900) {
        $specialty = $request->input("specialty");
        $doctor_id = $request->input("doctor_id");
        $hsp_id = $request->input("hsp_id");
        $availability = \Illuminate\Support\Facades\DB::select('select day,morning,evening from doctor_availability where doctor_id=? and hospital_id=?', [$doctor_id, $hsp_id]);
        //$hospitals= App\HospitalDoctor ::where('doctor_id','=',$doctor_id)->select('hospital_id')->get()->toArray();
        // $hospitals= App\HospitalDoctor ::where('doctor_id','=',$doctor_id)->join('hospital','hospital.hospital_id','=','hospital_doctor.hospital_id')->where('hospital.hospital_id','=',$hsp_id)->get();
        return $availability;
    } else {
        $hospitals = App\patientportal\modal\Hospital::all();
        return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');
    }
});

//Route::post('/makeappointment', 'DoctorAppointmentControllerOLD@insert');

//Route::post('/updateappointment', 'DoctorAppointmentControllerOLD@update');
//Route::get('/cancelappointment', 'DoctorAppointmentControllerOLD@cancel');

/* diagnostics routes */
Route::get('/diagnostics', function() {
    if (session('userID') && time() - session('logintime') < 900) {
        return view('diagnostics');
    } else {
        $hospitals = App\patientportal\modal\Hospital::all();
        return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');
    }
});

/* diagnostics routes */
Route::get('/pharmacies', function() {
    if (session('userID') && time() - session('logintime') < 900) {
        return view('pharmacies');
    } else {
        $hospitals =  App\patientportal\modal\Hospital::all();
        return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');
    }
});

/* Doctors routes */


Route::get('/clinicshospitalsdoctors', function() {
    if (session('userID') && time() - session('logintime') < 900) {
        return view('search');
    } else {
        $hospitals = App\patientportal\modal\Hospital::all();
        return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');
    }
});

/*
Route::get('/secondoption', function() {
    if (session('userID') && time() - session('logintime') < 900) {
        $hospitals = App\patientportal\modal\Hospital::all();
        $specialty =  App\patientportal\modal\Doctor::select('specialty')->distinct()->get();
        return view('secondoption')->with('specialty', $specialty)->with('hospitals', $hospitals);
    } else {
        $hospitals = App\patientportal\modal\Hospital::all();
        return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');
    }
});*/

Route::get('/otpconfirm', function() {
    if (session('userID') && time() - session('logintime') < 900) {
        $hospitals =  App\patientportal\modal\Hospital::all();
        return view('index')->with('hospitals', $hospitals);
    } else {
        $hospitals = App\patientportal\modal\Hospital::all();
        return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');
    }
});




Route::get('/articles', function() {
    if (session('userID') && time() - session('logintime') < 900) {
        $hospitals = App\patientportal\modal\Hospital::all();
        return view('articles')->with('hospitals', $hospitals);
    } else {
        $hospitals =  App\patientportal\modal\Hospital::all();
        return view('welcome')->with('hospitals', $hospitals)->with('sessionmsg', 'Session timed out Please Login again');
    }
});


//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', function()
{
    Auth::logout();
    Session::flush();
    return Redirect::to('/');
});

Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});