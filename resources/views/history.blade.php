@extends('layouts.app')
@section('title','Daiwik Patient Records')
@section('loadfunction',"openCity(event,\"Doctor\")")
@section('styletext')
<style>
    /* Style the tab */


    .tab_container .tab-content p,
    .tab_container .tab-content h3 {
        -webkit-animation: fadeInScale 0.7s ease-in-out;
        -moz-animation: fadeInScale 0.7s ease-in-out;
        animation: fadeInScale 0.7s ease-in-out;
    }
    .tab_container .tab-content h3  {
        text-align: center;
    }

    .tab_container [id^="tab"]:checked + label {
        background: #1f319f;
        box-shadow: inset 0 3px #1f319f;
        color:#fff;
    }

    .tab_container [id^="tab"]:checked + label .fa {
        color: #fff;
    }

    label .fa {
        font-size: 1.3em;
        margin: 0 0.4em 0 0;
    }

    /*Media query*/
    @media only screen and (max-width: 930px) {
        label span {
            font-size: 14px;
        }
        label .fa {
            font-size: 14px;
        }
    }

    @media only screen and (max-width: 768px) {
        label span {
            display: none;
        }

        label .fa {
            font-size: 16px;
        }

        .tab_container {
            width: 98%;
        }
    }

    /*Content Animation*/
    @keyframes fadeInScale {
        0% {
            transform: scale(0.9);
            opacity: 0;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }




    div.tab {
        overflow: hidden;
        border: 1px solid #060064;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    div.tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    div.tab button:hover {
        background-color: #060064;
        color:white;
    }

    /* Create an active/current tablink class */
    div.tab button.active {
        background-color: #060064;
        color:white;
    }

   
.th{
	
    vertical-align: bottom;
    border-bottom: 2px solid #ddd;
    font-size: 14px;
    background: #1f319f;
	color:#fff;
}

table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    font-size: 13px;
}



</style>
<script>


    jQuery(document).ready(function ($) {
    $(".scroll").click(function (event) {
    event.preventDefault();
    $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
    });
    });
    $(function() {

    var pickerOpts = {
    format: 'd-m-Y',
            //timepicker:true,
            // datepicker:true,
            changeMonth : true,
            changeYear : true,
            // showSeconds: true,
            showMonthAfterYear : true
    };
    $("#datepicker1").datetimepicker(pickerOpts);
    // $("#toDate").datetimepicker(pickerOpts1);

    });
    function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    }

    function populatetime(){

    $('#appointmenttime').val($("input[name='timeslot']:checked").val());
    }
    function loadtimeslots(){

    var doctor_id = $("#doctor").val();
    var hospital = $("#hospital").val();
    var date = $("#datepicker1").val();
    $.ajax({
    type: "get",
            url: 'timeslots',
            data: { doctor_id: doctor_id, hsp_id: hospital, date: date},
            dataType: 'json',
            success: function (msg) {

            var timeslots = "<table><tr><th colspan='5'>Morning Time's</th></tr><tr>";
            var mrng = msg['mrng'];
            for (var i = 0; i < mrng.length; i++) {
            if (i % 5 == 0) {
            timeslots = timeslots + "</tr><tr>";
            }
            timeslots = timeslots + "<td><input onchange='populatetime()' name='timeslot' type='radio' value='" + mrng[i] + "'/>" + mrng[i] + "</td> ";
            }
            timeslots = timeslots + "</tr><tr><th colspan='5'>Evening Time's</th></tr>";
            var mrng = msg['evng'];
            for (var i = 0; i < mrng.length; i++) {
            if (i % 5 == 0) {
            timeslots = timeslots + "</tr><tr>";
            }
            timeslots = timeslots + "<td><input onchange='populatetime()' name='timeslot' type='radio' value='" + mrng[i] + "'/>" + mrng[i] + "</td> ";
            }
            timeslots = timeslots + "</tr>";
            $("#timeslots").html(timeslots);
            }
    });
    }
    function openmodle(id){


    $.ajax({
    type: "GET",
            url: 'loadappointmentdetails',
            data: {id: id},
            dataType: 'json',
            success: function (msg) {

            for (var i = 0; i < msg.length; i++) {

            $('#appointment_id').val(msg[i]['id']);
            $('#appointment_id1').val(msg[i]['id']);
            var doc = "<option>Select Doctor</option>";
            doc = doc + "<option value='" + msg[i]['doctor_id'] + "' selected>" + msg[i]['name'] + "</option>";
            $("#doctor").html(doc);
            // $('#doctor').val(msg[i]['name']); 
            $('#hospital').val(msg[i]['hospital_id']);
            $('#address').val(msg[i]['address']);
            $('#briefnote').val(msg[i]['brief_history']);
            $('#datepicker1').val(msg[i]['appointment_date'].split(" ")[0]);
            $('#appointmenttime').val(msg[i]['time']);
            }
            $("#model").modal();
            }
    });
    }

</script>
@endsection
@section('bodycontent')
<br>
<!-- Appointment -->



<div class="tab tab_container">
    <button class="tablinks" onclick="openCity(event, 'Doctor')"><label for="tab1"><i class="fa fa-calendar" data-toggle="tooltip" title="Doctor Appointments"></i><span>Doctor Appointments </span></label>
    </button>
    <button class="tablinks" onclick="openCity(event, 'Diagnostics')"><label for="tab2"><i class="fa fa-calendar" data-toggle="tooltip" title="Diagnostics Appointments"></i><span>Diagnostics Appointments </span></label>
    </button>
    <button class="tablinks" onclick="openCity(event, 'Pharmacy')"><label for="tab3"><i class="fa fa-medkit" data-toggle="tooltip" title="Pharmacy Pickup"></i><span>Pharmacy Pickup </span></label>
    </button>
    <button class="tablinks" onclick="openCity(event, 'Checkup')"><label for="tab3"><i class="fa fa-medkit" data-toggle="tooltip" title="Health Checkups"></i><span>Health Checkups </span></label>
    </button>
    <button class="tablinks" onclick="openCity(event, 'askquestion')"><label for="tab4"><i class="fa fa-question" data-toggle="tooltip" title="Answered Questions"></i><span>Answered Questions</span></label>
    </button>
</div>

<div id="Doctor" class="tabcontent">

    <div class="container">
        <h5> Doctor Appointments</h5>
        @if (session()->has('msg'))
        <div class='success' align="center">
            <b>  {{session()->get('msg')}}</b>

        </div>
        @endif
        <?php $count=1;?>
        @if(count($doctorappointments)>0)
        <table class="table table-bordred table-striped"><thead class='th'>
            <th>SNO</th>
            <th>Doctor Name</th>
            <th>Hospital Name</th>
            <th>Appointment Date </th>
            <th>Appointment Time </th>
            <th>More Details</th>
            {{--<th>Reappointment</th>--}}
            </thead><tbody>
                @foreach ($doctorappointments as $appointment)
                <tr><td>{{ $count}}</td>
                    <td>{{ $appointment->name }} ({{ $appointment->specialty }}) </td>
                    <td>{{ $appointment->hospital_name }}</td>
                    <td>{{ explode(" ",$appointment->appointment_date)[0]  }}</td>
                    <td>{{ $appointment->time }}</td>
                    <td><a href="doctor_appointmentmsgnew?id={{ $appointment->id }}" target="_blank">Details</a></td>
                    {{--<td><a onclick="openmodle('{{ $appointment->id }}')" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>--}}
                    {{--</td>--}}
                </tr>
                <?php $count++;?>
                @endforeach
            </tbody></table>
        @endif




    </div>


</div>

<div id="Diagnostics" class="tabcontent">

<b>Blood Tests</b>
    <?php $count=1;?>
    @if(count($examinationDates["bloodTestDates"])>0)
        <table class="table table-bordred table-striped"><thead class='th'>
            <th>SNO</th>
            <th>Hospital Name</th>
            <th>Appointment Date </th>
            <th>Appointment Time </th>
            {{--<th>Hospital ID</th>--}}
            <th>More Details</th>
            {{--<th>Reappointment</th>--}}
            </thead><tbody>
            @foreach ($examinationDates["bloodTestDates"] as $appointment)
                <tr>
                    <td>{{ $count}}</td>
                    <td>{{ $appointment->hospital_name}}</td>
                    <td>{{ $appointment->examination_date}} </td>
                    <td>{{ $appointment->examination_time}}</td>
                    {{--<td>{{ $appointment->hospital_id}}</td>--}}
                    <td><a href="lab_appointmentmsg/patientId/{{session('patient_id')}}/hospitalId/{{$appointment->hospital_id}}/date/{{ $appointment->examination_date}}" target="_blank">Details</a></td>
                    {{--<td><a href="lab_appointmentmsg/patientId/{{session('patient_id')}}/hospitalId/{{$appointment->hospital_id}}/date/{{ $appointment->examination_date}}" target="_blank">Details</a></td>--}}

                </tr>
                <?php $count=0;?>
            @endforeach
            </tbody></table>
    @endif

    <b>Motion Tests</b>
    <?php $count=1;?>
@if(count($examinationDates["motionTestDates"])>0)
        <table class="table table-bordred table-striped"><thead class='th'>
            <th>SNo</th>
            <th>Hospital Name</th>
            <th>Appointment Date </th>
            <th>Appointment Time </th>
            {{--<th>Hospital ID</th>--}}
            <th>More Details</th>
            {{--<th>Reappointment</th>--}}
            </thead><tbody>
            @foreach ($examinationDates["motionTestDates"] as $appointment)
                <tr>
                    <td>{{ $count}}</td>
                    <td>{{ $appointment->hospital_name}}</td>
                    <td>{{ $appointment->examination_date}} </td>
                    <td>{{ $appointment->examination_time}}</td>
                    {{--<td>{{ $appointment->hospital_id}}</td>--}}
                    <td><a href="lab_appointmentmsg/patientId/{{session('patient_id')}}/hospitalId/{{$appointment->hospital_id}}/date/{{ $appointment->examination_date}}" target="_blank">Details</a></td>
                    {{--<td><a href="lab_appointmentmsg/patientId/{{session('patient_id')}}/hospitalId/{{$appointment->hospital_id}}/date/{{ $appointment->examination_date}}" target="_blank">Details</a></td>--}}

                </tr>
                <?php $count++;?>

            @endforeach
            </tbody></table>
    @endif

    <b>Urine Tests</b>
    <?php $count=1;?>
@if(count($examinationDates["urineTestDates"])>0)
        <table class="table table-bordred table-striped">
            <thead class='th'>
               <th>SNO</th>
            <th>Hospital Name</th>
            <th>Appointment Date </th>
            <th>Appointment Time </th>
            {{--<th>Hospital ID</th>--}}
            <th>More Details</th>
            {{--<th>Reappointment</th>--}}
            </thead>
            <tbody>
            @foreach ($examinationDates["urineTestDates"] as $appointment)
                <tr>
                    <td>{{ $count}}</td>
                    <td>{{ $appointment->hospital_name}}</td>
                    <td>{{ $appointment->examination_date}} </td>
                    <td>{{ $appointment->examination_time}}</td>
                    {{--<td>{{ $appointment->hospital_id}}</td>--}}
                    <td><a href="lab_appointmentmsg/patientId/{{session('patient_id')}}/hospitalId/{{$appointment->hospital_id}}/date/{{ $appointment->examination_date}}" target="_blank">Details</a></td>
                    {{--<td><a href="lab_appointmentmsg/patientId/{{session('patient_id')}}/hospitalId/{{$appointment->hospital_id}}/date/{{ $appointment->examination_date}}" target="_blank">Details</a></td>--}}

                </tr>
                <?php $count++;?>
            @endforeach
            </tbody>
        </table>
    @endif

    <b>Ultrasound Tests</b>
    <?php $count=1;?>
    @if(count($examinationDates["ultraSoundTestDates"])>0)
        <table class="table table-bordred table-striped">
            <thead class='th'>
            <th>SNO</th>
            <th>Hospital Name</th>
            <th>Appointment Date </th>
            <th>Appointment Time </th>
            {{--<th>Hospital ID</th>--}}
            <th>More Details</th>
            {{--<th>Reappointment</th>--}}
            </thead>
            <tbody>
            @foreach ($examinationDates["ultraSoundTestDates"] as $appointment)
                <tr>
                    <td>{{ $count}}</td>
                    <td>{{ $appointment->hospital_name}}</td>
                    <td>{{ $appointment->examination_date}} </td>
                    <td>{{ $appointment->examination_time}}</td>
                    {{--<td>{{ $appointment->hospital_id}}</td>--}}
                    <td><a href="lab_appointmentmsg/patientId/{{session('patient_id')}}/hospitalId/{{$appointment->hospital_id}}/date/{{ $appointment->examination_date}}" target="_blank">Details</a></td>
                    {{--<td><a href="lab_appointmentmsg/patientId/{{session('patient_id')}}/hospitalId/{{$appointment->hospital_id}}/date/{{ $appointment->examination_date}}" target="_blank">Details</a></td>--}}

                </tr>
                <?php $count++;?>
            @endforeach
            </tbody>
        </table>
    @endif

    <b>Scan Tests</b>
    <?php $count=1;?>
    @if(count($examinationDates["scanTestDates"])>0)
        <table class="table table-bordred table-striped">
            <thead class='th'>
            <th>SNO</th>
            <th>Hospital Name</th>
            <th>Appointment Date </th>
            <th>Appointment Time </th>
            <th>More Details</th>
            </thead>
            <tbody>
            @foreach ($examinationDates["scanTestDates"] as $appointment)
                <tr>
                    <td>{{ $count}}</td>
                    <td>{{ $appointment->hospital_name}}</td>
                    <td>{{ $appointment->scan_date}} </td>
                    <td>{{ $appointment->examination_time}}</td>
                    <td><a href="lab_appointmentmsg/patientId/{{session('patient_id')}}/hospitalId/{{$appointment->hospital_id}}/date/{{ $appointment->scan_date}}" target="_blank">Details</a></td>
                </tr>
                <?php $count++;?>
            @endforeach
            </tbody>
        </table>
    @endif

    <b>Dental Tests</b>
    <?php $count=1;?>
    @if(count($examinationDates["dentalTestDates"])>0)
        <table class="table table-bordred table-striped">
            <thead class='th'>
            <th>SNO</th>
            <th>Hospital Name</th>
            <th>Appointment Date </th>
            <th>Appointment Time </th>
            <th>More Details</th>
            </thead>
            <tbody>
            @foreach ($examinationDates["dentalTestDates"] as $appointment)
                <tr>
                    <td>{{ $count}}</td>
                    <td>{{ $appointment->hospital_name}}</td>
                    <td>{{ $appointment->examination_date}} </td>
                    <td>{{ $appointment->examination_time}}</td>
                    <td><a href="lab_appointmentmsg/patientId/{{session('patient_id')}}/hospitalId/{{$appointment->hospital_id}}/date/{{ $appointment->examination_date}}" target="_blank">Details</a></td>
                </tr>
                <?php $count++;?>
            @endforeach
            </tbody>
        </table>
    @endif

    <b>X-ray Tests</b>
    <?php $count=1;?>
    @if(count($examinationDates["xrayTestDates"])>0)
        <table class="table table-bordred table-striped">
            <thead class='th'>
            <th>SNO</th>
            <th>Hospital Name</th>
            <th>Appointment Date </th>
            <th>Appointment Time </th>
            <th>More Details</th>
            </thead>
            <tbody>
            @foreach ($examinationDates["xrayTestDates"] as $appointment)
                <tr>
                    <td>{{ $count}}</td>
                    <td>{{ $appointment->hospital_name}}</td>
                    <td>{{ $appointment->examination_date}} </td>
                    <td>{{ $appointment->examination_time}}</td>
                    <td><a href="lab_appointmentmsg/patientId/{{session('patient_id')}}/hospitalId/{{$appointment->hospital_id}}/date/{{ $appointment->examination_date}}" target="_blank">Details</a></td>
                </tr>
                <?php $count++;?>
            @endforeach
            </tbody>
        </table>
    @endif


</div>

<div id="askquestion" class="tabcontent">
    <div class="container">


        <h5 > Answered Questions</h5>
        <?php $count=1;?>
        @if(count($askquestions)>0)
         <table class="table table-bordred table-striped"><thead class='th'>
             <th>SNO</th>
             {{--<th>Doctor Name</th>--}}
             <th>Hospital Name</th>
             <th>Request Date </th>
             <th>Response Date </th>
             <th>Question Type </th>
             <th>More Details</th></thead>
            @foreach ($askquestions as $appointment)
            <tr> <td>{{ $count}}</td>
                <td>{{ $appointment->name }} </td>
                {{--<td>{{ $appointment->hospital_name }}</td>--}}
                <td>{{ $appointment->created_at }}</td>
                <td>{{ $appointment->response_date }}</td>
                <td>{{ $appointment->question_type }}</td>
                <td>
               <a href="ask_appointmentmsg?did={{ $appointment->doctor_id }}&date={{$appointment->created_at}}" target="_blank">Details</a></td>
            </tr>
                 <?php $count++;?>
            @endforeach
        </table>
        {{ $askquestions ->links() }}
            @endif

    </div>

</div>


<div id="Pharmacy" class="tabcontent">
    <div class="container">

        <h5> Pharmacy Pickup</h5>
        @if(count($pharmacyappointments)>0)
         <table class="table table-bordred table-striped"><thead class='th'><th>Pharmacy Name</th><th>Hospital Name</th><th>Pickup Date&Time </th><th>More Details</th></thead>
            @foreach ($pharmacyappointments as $appointment)
            <tr><td>{{ $appointment->name }} </td><td>{{ $appointment->hospital_name }}</td><td>{{ $appointment->appointment_date }}</td><td><a href="pharmacy_appointmentmsg?id={{ $appointment->id }}" target="_blank">Details</a></td></tr>

            @endforeach
        </table>
        {{ $pharmacyappointments ->links() }}
            @endif
    </div>
</div>

<div id="Checkup" class="tabcontent">
    <div class="container">

        <h5> Health Checkup</h5>
        @if(count($healthcheckups)>0)
            <table class="table table-bordred table-striped"><thead class='th'><th>Health Checkup</th><th>Hospital Name</th><th>Appointment </th><th>More Details</th></thead>
                @foreach ($healthcheckups as $checkup)
                    <tr><td>{{ $checkup->package_name }} </td><td>{{ $checkup->hospital_name }}</td><td>{{ $checkup->appointment_date }}</td><td><a href="healthcheckupdetails?id={{ $checkup->id }}" target="_blank">Details</a></td></tr>

                @endforeach
            </table>
            {{ $pharmacyappointments ->links() }}
        @endif
    </div>
</div>

<!-- modal -->
<div class="modal about-modal w3-agileits fade" id="model" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
            </div> 
            <div class="modal-body login-page "><!-- login-page -->     
                <div class="login-top sign-top">
                    <div class="agileits-login">
                        <h5>Reappointment</h5>
                        <form action="updateappointment" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="hospital" id="hospital" class="form-control input-md" placeholder="Hospital" style="width:100%">

                            <input  type="hidden" name="address" id="address" class="form-control input-md" placeholder="address" style="width:100%">

                            <input type="hidden" name="appointment_id" id="appointment_id" class="form-control input-md" placeholder="Hospital" style="width:100%">
                            <label>Doctor</label>
                            <select name="doctor" id ="doctor" class="form-control input-md" placeholder="Doctor" style="width:100%">
                                <option>Select Doctor</option>
                            </select>

                            <label>Brief Note</label>
                            <textarea  id="briefnote" name="briefnote" class="form-control input-md"  value="" placeholder="Brief Note" required="" style="width:100%"></textarea>
                            Appointment Date
                            <input  id="datepicker11" name="date" class="form-control input-md" name="Text" type="date" value="" onchange="loadtimeslots()" onfocus="this.value = '';" onblur="if (this.value == '') {
                        ;
                        }" placeholder="Appointment Date and Time" required="" style="width:100% ;line-height: 26px;">
                            Appointment Time
                            <input  type="time" name="appointmenttime" id="appointmenttime" class="form-control input-md" placeholder="Appointment Time" style="width:100%; line-height: 26px;">

                            <div id="timeslots"></div>

<br><br>
                            <input type="submit" value="Update Appointment" class="btn btn-skin btn-block btn-lg" name="submit" style="width:100%">
                            <br>

                        </form>
                        <form action="cancelappointment" method="get">
                            
                            <input type="hidden" name="appointment_id1" id="appointment_id1"  placeholder="Hospital" style="width:100%">

                            <input type="submit" value="Cancel Appointment" name="submit" class="btn btn-skin btn-block btn-lg" style="width:100%">

                        </form>
                    </div>  
                </div>
            </div>  
        </div> <!-- //login-page -->
    </div>
</div>
<!-- //modal -->
@endsection
