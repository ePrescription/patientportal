@extends('layouts.app')
@section('title','Daiwik Doctor Appointment')
@section('styletext')
    <style>
        .error {
            color: red;
        }

        .red {
            color: red;
        }

        @media (max-width:480px) {
            .text-width{
                width:100%;

            }
        }
    </style>
    <?php
    $time_array = array(
        '00:00:00' => '12:00 AM', '00:05:00' => '12:05 AM', '00:10:00' => '12:10 AM', '00:15:00' => '12:15 AM', '00:20:00' => '12:20 AM', '00:25:00' => '12:25 AM', '00:30:00' => '12:30 AM', '00:35:00' => '12:35 AM', '00:40:00' => '12:40 AM', '00:45:00' => '12:45 AM', '00:50:00' => '12:50 AM', '00:55:00' => '12:55 AM',
        '01:00:00' => '01:00 AM', '01:05:00' => '01:05 AM', '01:10:00' => '01:10 AM', '01:15:00' => '01:15 AM', '01:20:00' => '01:20 AM', '01:25:00' => '01:25 AM', '01:30:00' => '01:30 AM', '01:35:00' => '01:35 AM', '01:40:00' => '01:40 AM', '01:45:00' => '01:45 AM', '01:50:00' => '01:50 AM', '01:55:00' => '01:55 AM',
        '02:00:00' => '02:00 AM', '02:05:00' => '02:05 AM', '02:10:00' => '02:10 AM', '02:15:00' => '02:15 AM', '02:20:00' => '02:20 AM', '02:25:00' => '02:25 AM', '02:30:00' => '02:30 AM', '02:35:00' => '02:35 AM', '02:40:00' => '02:40 AM', '02:45:00' => '02:45 AM', '02:50:00' => '02:50 AM', '02:55:00' => '02:55 AM',
        '03:00:00' => '03:00 AM', '03:05:00' => '03:05 AM', '03:10:00' => '03:10 AM', '03:15:00' => '03:15 AM', '03:20:00' => '03:20 AM', '03:25:00' => '03:25 AM', '03:30:00' => '03:30 AM', '03:35:00' => '03:35 AM', '03:40:00' => '03:40 AM', '03:45:00' => '03:45 AM', '03:50:00' => '03:50 AM', '03:55:00' => '03:55 AM',
        '04:00:00' => '04:00 AM', '04:05:00' => '04:05 AM', '04:10:00' => '04:10 AM', '04:15:00' => '04:15 AM', '04:20:00' => '04:20 AM', '04:25:00' => '04:25 AM', '04:30:00' => '04:30 AM', '04:35:00' => '04:35 AM', '04:40:00' => '04:40 AM', '04:45:00' => '04:45 AM', '04:50:00' => '04:50 AM', '04:55:00' => '04:55 AM',
        '05:00:00' => '05:00 AM', '05:05:00' => '05:05 AM', '05:10:00' => '05:10 AM', '05:15:00' => '05:15 AM', '05:20:00' => '05:20 AM', '05:25:00' => '05:25 AM', '05:30:00' => '05:30 AM', '05:35:00' => '05:35 AM', '05:40:00' => '05:40 AM', '05:45:00' => '05:45 AM', '05:50:00' => '05:50 AM', '05:55:00' => '05:55 AM',
        '06:00:00' => '06:00 AM', '06:05:00' => '06:05 AM', '06:10:00' => '06:10 AM', '06:15:00' => '06:15 AM', '06:20:00' => '06:20 AM', '06:25:00' => '06:25 AM', '06:30:00' => '06:30 AM', '06:35:00' => '06:35 AM', '06:40:00' => '06:40 AM', '06:45:00' => '06:45 AM', '06:50:00' => '06:50 AM', '06:55:00' => '06:55 AM',
        '07:00:00' => '07:00 AM', '07:05:00' => '07:05 AM', '07:10:00' => '07:10 AM', '07:15:00' => '07:15 AM', '07:20:00' => '07:20 AM', '07:25:00' => '07:25 AM', '07:30:00' => '07:30 AM', '07:35:00' => '07:35 AM', '07:40:00' => '07:40 AM', '07:45:00' => '07:45 AM', '07:50:00' => '07:50 AM', '07:55:00' => '07:55 AM',
        '08:00:00' => '08:00 AM', '08:05:00' => '08:05 AM', '08:10:00' => '08:10 AM', '08:15:00' => '08:15 AM', '08:20:00' => '08:20 AM', '08:25:00' => '08:25 AM', '08:30:00' => '08:30 AM', '08:35:00' => '08:35 AM', '08:40:00' => '08:40 AM', '08:45:00' => '08:45 AM', '08:50:00' => '08:50 AM', '08:55:00' => '08:55 AM',
        '09:00:00' => '09:00 AM', '09:05:00' => '09:05 AM', '09:10:00' => '09:10 AM', '09:15:00' => '09:15 AM', '09:20:00' => '09:20 AM', '09:25:00' => '09:25 AM', '09:30:00' => '09:30 AM', '09:35:00' => '09:35 AM', '09:40:00' => '09:40 AM', '09:45:00' => '09:45 AM', '09:50:00' => '09:50 AM', '09:55:00' => '09:55 AM',
        '10:00:00' => '10:00 AM', '10:05:00' => '10:05 AM', '10:10:00' => '10:10 AM', '10:15:00' => '10:15 AM', '10:20:00' => '10:20 AM', '10:25:00' => '10:25 AM', '10:30:00' => '10:30 AM', '10:35:00' => '10:35 AM', '10:40:00' => '10:40 AM', '10:45:00' => '10:45 AM', '10:50:00' => '10:50 AM', '10:55:00' => '10:55 AM',
        '11:00:00' => '11:00 AM', '11:05:00' => '11:05 AM', '11:10:00' => '11:10 AM', '11:15:00' => '11:15 AM', '11:20:00' => '11:20 AM', '11:25:00' => '11:25 AM', '11:30:00' => '11:30 AM', '11:35:00' => '11:35 AM', '11:40:00' => '11:40 AM', '11:45:00' => '11:45 AM', '11:50:00' => '11:50 AM', '11:55:00' => '11:55 AM',
        '12:00:00' => '12:00 PM', '12:05:00' => '12:05 PM', '12:10:00' => '12:10 PM', '12:15:00' => '12:15 PM', '12:20:00' => '12:20 PM', '12:25:00' => '12:25 PM', '12:30:00' => '12:30 PM', '12:35:00' => '12:35 PM', '12:40:00' => '12:40 PM', '12:45:00' => '12:45 PM', '12:50:00' => '12:50 AM', '12:55:00' => '12:55 AM',
        '13:00:00' => '01:00 PM', '13:05:00' => '01:05 PM', '13:10:00' => '01:10 PM', '13:15:00' => '01:15 PM', '13:20:00' => '01:20 PM', '13:25:00' => '01:25 PM', '13:30:00' => '01:30 PM', '13:35:00' => '01:35 PM', '13:40:00' => '01:40 PM', '13:45:00' => '01:45 PM', '13:50:00' => '01:50 PM', '13:55:00' => '01:55 PM',
        '14:00:00' => '02:00 PM', '14:05:00' => '02:05 PM', '14:10:00' => '02:10 PM', '14:15:00' => '02:15 PM', '14:20:00' => '02:20 PM', '14:25:00' => '02:25 PM', '14:30:00' => '02:30 PM', '14:35:00' => '02:35 PM', '14:40:00' => '02:40 PM', '14:45:00' => '02:45 PM', '14:50:00' => '02:50 PM', '14:55:00' => '02:55 PM',
        '15:00:00' => '03:00 PM', '15:05:00' => '03:05 PM', '15:10:00' => '03:10 PM', '15:15:00' => '03:15 PM', '15:20:00' => '03:20 PM', '15:25:00' => '03:25 PM', '15:30:00' => '03:30 PM', '15:35:00' => '03:35 PM', '15:40:00' => '03:40 PM', '15:45:00' => '03:45 PM', '15:50:00' => '03:50 PM', '15:55:00' => '03:55 PM',
        '16:00:00' => '04:00 PM', '16:05:00' => '04:05 PM', '16:10:00' => '04:10 PM', '16:15:00' => '04:15 PM', '16:20:00' => '04:20 PM', '16:25:00' => '04:25 PM', '16:30:00' => '04:30 PM', '16:35:00' => '04:35 PM', '16:40:00' => '04:40 PM', '16:45:00' => '04:45 PM', '16:50:00' => '04:50 PM', '16:55:00' => '04:55 PM',
        '17:00:00' => '05:00 PM', '17:05:00' => '05:05 PM', '17:10:00' => '05:10 PM', '17:15:00' => '05:15 PM', '17:20:00' => '05:20 PM', '17:25:00' => '05:25 PM', '17:30:00' => '05:30 PM', '17:35:00' => '05:35 PM', '17:40:00' => '05:40 PM', '17:45:00' => '05:45 PM', '17:50:00' => '05:50 PM', '17:55:00' => '05:55 PM',
        '18:00:00' => '06:00 PM', '18:05:00' => '06:05 PM', '18:10:00' => '06:10 PM', '18:15:00' => '06:15 PM', '18:20:00' => '06:20 PM', '18:25:00' => '06:25 PM', '18:30:00' => '06:30 PM', '18:35:00' => '06:35 PM', '18:40:00' => '06:40 PM', '18:45:00' => '06:45 PM', '18:50:00' => '06:50 PM', '18:55:00' => '06:55 PM',
        '19:00:00' => '07:00 PM', '19:05:00' => '07:05 PM', '19:10:00' => '07:10 PM', '19:15:00' => '07:15 PM', '19:20:00' => '07:20 PM', '19:25:00' => '07:25 PM', '19:30:00' => '07:30 PM', '19:35:00' => '07:35 PM', '19:40:00' => '07:40 PM', '19:45:00' => '07:45 PM', '19:50:00' => '07:50 PM', '19:55:00' => '07:55 PM',
        '20:00:00' => '08:00 PM', '20:05:00' => '08:05 PM', '20:10:00' => '08:10 PM', '20:15:00' => '08:15 PM', '20:20:00' => '08:20 PM', '20:25:00' => '08:25 PM', '20:30:00' => '08:30 PM', '20:35:00' => '08:35 PM', '20:40:00' => '08:40 PM', '20:45:00' => '08:45 PM', '20:50:00' => '08:50 PM', '20:55:00' => '08:55 PM',
        '21:00:00' => '09:00 PM', '21:05:00' => '09:05 PM', '21:10:00' => '09:10 PM', '21:15:00' => '09:15 PM', '21:20:00' => '09:20 PM', '21:25:00' => '09:25 PM', '21:30:00' => '09:30 PM', '21:35:00' => '09:35 PM', '21:40:00' => '09:40 PM', '21:45:00' => '09:45 PM', '21:50:00' => '09:50 PM', '21:55:00' => '09:55 PM',
        '22:00:00' => '10:00 PM', '22:05:00' => '10:05 PM', '22:10:00' => '10:10 PM', '22:15:00' => '10:15 PM', '22:20:00' => '10:20 PM', '22:25:00' => '10:25 PM', '22:30:00' => '10:30 PM', '22:35:00' => '10:35 PM', '22:40:00' => '10:40 PM', '22:45:00' => '10:45 PM', '22:50:00' => '10:50 PM', '22:55:00' => '10:55 PM',
        '23:00:00' => '11:00 PM', '23:05:00' => '11:05 PM', '23:10:00' => '11:10 PM', '23:15:00' => '11:15 PM', '23:20:00' => '11:20 PM', '23:25:00' => '11:25 PM', '23:30:00' => '11:30 PM', '23:35:00' => '11:35 PM', '23:40:00' => '11:40 PM', '23:45:00' => '11:45 PM', '23:50:00' => '11:50 PM', '23:55:00' => '11:55 PM',

    );
    ?>

    <script>
        $(function () {

            var pickerOpts = {
                format: 'd-m-Y',
                //timepicker:true,
                // datepicker:true,
                changeMonth: true,
                changeYear: true,
                // showSeconds: true,
                showMonthAfterYear: true,
            };


            $("#datepicker1").datetimepicker(pickerOpts);
            // $("#toDate").datetimepicker(pickerOpts1);

        });


        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
            /* $("#doctorId").change(function () {
                 var specialist = $('#specialist').val();
                 var doctor_id = $("#doctorId").val();
                 var BASEURL = "{{ URL::to('/') }}/";
                var status = 1;
                var callurl = BASEURL + 'loadhospitals';

                $.ajax({
                    type: "GET",
                    url: callurl,
                    data: {specialist: specialist, doctor_id: doctor_id},
                    dataType: 'json',
                    success: function (msg) {
                        var list = "<option>Select Hospitals</option>";
                        for (var i = 0; i < msg.length; i++) {
                            list = list + "<option value='" + msg[i]['hospital_id'] + "'>" + msg[i]['hospital_name'] + "</option>";
                        }
                        $("#hospitalId").html(list);
                    }
                });

            });*/

            $("#typeoftest").change(function () {
                var testtype = $('#typeoftest').val();

                $.ajax({
                    type: "GET",
                    url: 'loadsubtest',
                    data: {testtype: testtype},
                    dataType: 'json',
                    success: function (msg) {
                        var list = "<option>Select Test Type</option>";
                        for (var i = 0; i < msg.length; i++) {
                            list = list + "<option value='" + msg[i]['id'] + "'>" + msg[i]['test_name'] + "</option>";
                        }
                        $("#subtest").html(list);
                    }
                });

            });


            $("#hospitalId").change(function () {
                //alert();
                var BASEURL = "{{ URL::to('/') }}/";
                var hid = $("#hospitalId").val();
                var did = $("#doctorId").val();
                //var date=$("#TestDate").val();
                //alert(date);
                var status = 1;
                var callurl = BASEURL + '/hospital/' + hid + '/HospitalDoctors';
                //  alert(callurl);
                $.ajax({
                    url: callurl,
                    type: "get",
                    data: {"id": hid, "status": status},
                    success: function (data) {

                        var list = "<option value=''>Select Doctor</option>";
                        for (var i = 0; i < data.length; i++) {

                            list = list + "<option value='" + data[i]['doctor_id'] + "'>" + data[i]['name'] + "</option>";
                        }
                        $("#doctorId").html(list);
                    }


                });
            });


            $("#labs").change(function () {

                var address = $("#labs :selected").text();
                var url = "https://www.mapsdirections.info/en/custom-google-maps/map.php?width=400&height=170&hl=ru&q=" + address + "+(Here)&ie=UTF8&t=&z=14&iwloc=A&output=embed";
                $('#location1').attr('src', url);
                $("#availablity1").html("<font style='color:white'>" + address + "</font>");

            });


            $("#hospital").change(function () {
                var specialist = $('#specialist').val();
                var doctor_id = $("#doctorId").val();
                var hospital_id = $("#hospital").val();
                var BASEURL = "{{ URL::to('/') }}/";
                var status = 1;
                $.ajax({
                    type: "get",
                    url: 'loadAddress',
                    data: {specialist: specialist, doctor_id: doctor_id, hsp_id: hospital_id},
                    dataType: 'json',
                    success: function (msg) {

                        var list = "<option>Select Address</option>";
                        for (var i = 0; i < msg.length; i++) {

                            list = list + "<option value='" + msg[i]['address'] + "'>" + msg[i]['address'] + "</option>";
                            var url = "https://www.mapsdirections.info/en/custom-google-maps/map.php?width=400&height=170&hl=ru&q=" + msg[i]['address'] + "+(Here)&ie=UTF8&t=&z=14&iwloc=A&output=embed";
                            $('#location').attr('src', url);

                        }

                        $("#address").html(list);
                    }
                });
                $.ajax({
                    type: "get",
                    url: 'doctoravailability',
                    data: {specialist: specialist, doctor_id: doctor_id, hsp_id: hospital},
                    dataType: 'json',
                    success: function (msg) {

                        var list = "<table class='table table-bordered' style='color:black;font-size:13px;'><thead> <tr><th>Day</th> <th>Morning</th><th> Evening</th></tr></thead><tbody>";
                        for (var i = 0; i < msg.length; i++) {

                            list = list + "<tr><td>" + msg[i]['day'] + "</td><td> " + msg[i]['morning'] + "</td><td>" + msg[i]['evening'] + "</td></tr> ";

                        }

                        $("#availablity").html(list + "<tbody></table>");

                    }
                });


            });
            /*
                        $("#hospitalId").change(function () {
                            var hospital_id = $('#hospitalId').val();

                            $.ajax({
                                type: "get",
                                url: 'loadpharmacy',
                                data: {hospital_id: hospital_id},
                                dataType: 'json',
                                success: function (msg) {

                                    var list = "<option>Select Pharmacy</option>";
                                    for (var i = 0; i < msg.length; i++) {
                                        list = list + "<option value='" + msg[i]['pharmacy_id'] + "'>" + msg[i]['name'] + "</option>";
                                        var url = "https://www.mapsdirections.info/en/custom-google-maps/map.php?width=400&height=170&hl=ru&q=" + msg[i]['address'] + "+(Here)&ie=UTF8&t=&z=14&iwloc=A&output=embed";
                                        $('#location3').attr('src', url);

                                        var details = "<font style='color:white'> Name :" + msg[i]['name'] + "<br> Address :" + msg[i]['address'] + " <br>Telephone:" + msg[i]['telephone'] + " Mail:" + msg[i]['email'] + "</font>";
                                        $('#pharmacyaddress').html(details)
                                    }

                                    $("#pharmacy_id").html(list);
                                }
                            });
                        });


                        /*  $("#datepicker1").change(function () {
                              var specialist = $('#specialist').val();
                              var doctor_id = $("#doctor").val();
                              var hospital = $("#hospital").val();
                              var date = $("#datepicker1").val();

                              $.ajax({
                                  type: "get",
                                  url: 'timeslots',
                                  data: {specialist: specialist, doctor_id: doctor_id, hsp_id: hospital, date: date},
                                  dataType: 'json',
                                  success: function (msg) {

                                      var timeslots = "<table><tr><th colspan='5'>Morning Time's</th></tr><tr>";
                                      var mrng = msg['mrng'];

                                      for (var i = 0; i < mrng.length; i++) {
                                          if (i % 5 == 0) {
                                              timeslots = timeslots + "</tr><tr>";
                                          }
                                          timeslots = timeslots + "<td><input name='timeslot' type='radio' value='" + mrng[i] + "'/>" + mrng[i] + "</td> ";

                                      }
                                      timeslots = timeslots + "</tr><tr><th colspan='5'>Evening Time's</th></tr>";

                                      var mrng = msg['evng'];

                                      for (var i = 0; i < mrng.length; i++) {
                                          if (i % 5 == 0) {
                                              timeslots = timeslots + "</tr><tr>";
                                          }
                                          timeslots = timeslots + "<td><input name='timeslot' type='radio' value='" + mrng[i] + "'/>" + mrng[i] + "</td> ";

                                      }
                                      timeslots = timeslots + "</tr>";
                                      $("#timeslots").html(timeslots);
                                  }
                              });



                          });*/


            $("#specialist").change(function () {
                var specialist = $('#specialist').val();
                var BASEURL = "{{ URL::to('/') }}/";
                var status = 1;
                var callurl = BASEURL + 'loaddoctor';

                $.ajax({
                    type: "GET",
                    url: callurl,
                    data: {specialist: specialist},
                    dataType: 'json',
                    success: function (msg) {
                        var list = "<option>Select Doctor</option>";
                        for (var i = 0; i < msg.length; i++) {
                            list = list + "<option value='" + msg[i]['doctor_id'] + "'>" + msg[i]['name'] + "</option>";
                        }
                        $("#doctorId").html(list);
                    }
                });
            });
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


    </script>
@endsection
@section('bodycontent')
    <section id="intro" class="intro" style="margin-bottom:50px;">
        <div class="intro-content">
            <div class="container" style="width: 100%;">
                <div class="row" style="width: 100%;">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <div class="panel panel-skin">
                            <div class="panel-heading">

                                <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Book Doctor's
                                    appointment
                                    <small></small>
                                </h3>
                            </div>

                            <div class="panel-body">
                                <div id="sendmessage">Your message has been sent. Thank you!</div>
                                <div id="errormessage"></div>
                                @if (session()->has('msg'))
                                    <div class='alert success'>
                                        <b style="color: green">  {{session()->get('msg')}}</b>

                                    </div>
                                @endif

                                <form action="{{URL::to('/')}}/makeappointment" role="form" method="POST"
                                      id="appointment" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row">

                                        <input type="hidden" class="form-control" id="patientId" name="patientId"
                                               value="{{Session::get('patient_id')}}" required="required"/>

                                    <!--   <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Name<span class="red">*</span></label>
                                                <input type="text" pattern="[a-zA-Z\s]+"
                                                       title="Please Enter Characters Onlky" class="form-control"
                                                       id="name" name="name" value="" required="required"/>
                                                @if ($errors->has('name'))<p class="error" style="">{!!$errors->first('name')!!}</p>@endif

                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Email<span class="red">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                   value="" required="required"/>
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Mobile<span class="red">*</span></label>
                                            <input type="number" min="0" class="form-control" id="telephone"
                                                   name="telephone" value="" required="required" maxlength="10"/>
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Age<span class="red">*</span></label>
                                            <input type="number" min="0" class="form-control" id="age" name="age"
                                                   value="" required="required"/>
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                   <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Gender<span class="red">*</span></label>
                                            <input type="radio" class="form-controlx" id="gender1" name="gender"
                                                   value="1" required="required"/>&nbsp;&nbsp;Male
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="radio" class="form-controlx" id="gender2" name="gender"
                                                       value="0" required="required"/>&nbsp;&nbsp;Female
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Marital Status<span class="red">*</span></label>
                                                <input type="radio" class="form-controlx" id="married1"
                                                       name="maritalStatus" value="1" required="required"/>&nbsp;&nbsp;Married

                                                <input type="radio" class="form-controlx" id="married2"
                                                       name="maritalStatus" value="0" required="required"/>&nbsp;&nbsp;Unmarried
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Occupation</label>
                                                <select class="form-control" name="occupation" id="occupation">
                                                    <option value="" selected></option>
                                                    <option value="Daily Labour">Daily Labour</option>
                                                    <option value="Farmer">Farmer</option>
                                                    <option value="Gov.Employee">Gov.Employee</option>
                                                    <option value="House Wife">House Wife</option>
                                                    <option value="Private Employee">Private Employee</option>
                                                    <option value="Self Employee">Self Employee</option>
                                                    <option value="Student">Student</option>

                                                </select>
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>C/o</label>
                                                <input type="text" class="form-control" name="careof" id="careof"
                                                       value=""/>
                                                <div class="validation"></div>
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>DOB</label>
                                                <input type="date" class="form-control" name="dob" id="dob" style="line-height: 20px;"  value=""/>
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Relationship</label>
                                                <select class="form-control" name="relationship" id="relationship">
                                                    <option value="" selected></option>
                                                    <option value="Brother">Brother</option>
                                                    <option value="Sister">Sister</option>
                                                    <option value="Husband">Husband</option>
                                                    <option value="Wife">Wife</option>
                                                    <option value="Father">Father</option>
                                                    <option value="Mother">Mother</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Relation Name</label>
                                                <input type="text" class="form-control" name="spouseName"
                                                       id="spouseName" value=""/>
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" id="address" name="address"></textarea>
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Photo</label>
                                                <input type="file" class="form-control" name="patient_photo"
                                                       id="patient_photo">
                                                <div class="validation"></div>
                                            </div>
                                        </div>-->

                                        <h4 class="m-t-0 m-b-30">Appointment Info</h4>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>AppointmentType<span class="red">*</span></label>
                                                <select name="appointmentCategory" id="appointmentCategory"
                                                        class="form-control" required="required">
                                                    <option value="">--CHOOSE--</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Special">Special</option>
                                                    <option value="Pregnancy">Pregnancy</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Select Date<span class="red">*</span></label>
                                                <input type="text" class="form-control" name="appointmentDate"
                                                       id="TestDate" value="{{date('Y-m-d')}}"
                                                       style="line-height: 20px;" required="required"
                                                       onchange="javascript:appointmentTypePatient(); "/>
                                                <div class="validation"></div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Select Hospital</label>
                                                <select name="hospitalId" id="hospitalId"
                                                        onchange="LoadDoctors(this.value)" class="form-control input-md"
                                                        placeholder="Hospital" required>
                                                    <option value="">Select Hospital</option>
                                                    @foreach ($hospitals as $val)

                                                        <option value="{{ $val['hospital_id'] }}">{{ $val['hospital_name'] }}</option>

                                                    @endforeach

                                                </select>
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Select Doctor</label>
                                                <select name="doctorId" id="doctorId"
                                                        onchange="javascript:appointmentTypePatient(); "
                                                        class="form-control input-md"
                                                        placeholder="doctor">
                                                    <option value="">Select Doctor</option>
                                                </select>
                                                <div class="validation"></div>
                                            </div>
                                        </div>


                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Appointment Time<span class="red">*</span></label>
                                                <select class="form-control text-width" name="appointmentTime" id="appointmentTime"
                                                        required="required"
                                                        onchange="javascript:getTokenId(this.value);">

                                                    <option value=""> --:----</option>
                                                    @foreach($time_array as $time_value)
                                                        <?php $key = array_keys($time_array, $time_value); ?>
                                                        <option value="{{$key[0]}}"> {{$time_value}} </option>
                                                    @endforeach

                                                </select>
                                                <div class="validation"></div>

                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6" id="token" style="display: none">
                                            <div class="form-group">
                                                <b>Your Token ID:</b>
                                                <p name="tokenId" id="tokenId" required="required" readonly
                                                   style="font-size: 20px;color: blue;"></p>

                                            </div>
                                        </div>
                                    <!--<div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Select Speciality<span class="red">*</span></label>

                                                <select name="specialist" id="specialist" class="form-control input-md"
                                                        placeholder="Specialist">
                                                    <option>Select Speciality</option>
                                                    @foreach ($specialty as $val)

                                        <option value="{{ $val['specialty'] }}">{{ $val['specialty'] }}</option>

                                                    @endforeach

                                            </select>
                                            <div class="validation"></div>
                                        </div>
                                    </div>-->


                                        <!--  <div class="col-xs-6 col-sm-6 col-md-6">
                                              <div class="form-group">
                                                  <label>Select Address</label>
                                                  <select name="address" id="address" class="form-control input-md"
                                                          placeholder="Address">
                                                      <option>Select Address</option>
                                                  </select>
                                                  <div class="validation"></div>
                                              </div>
                                          </div>
                                      </div>
                                     <div class="col-md-6 col-sm-12 col-xs-12">
                                          <div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">
                                              <h2 class="h-ultra">Doctor's Availability </h2>
                                              <div style="height: 200px;overflow-y: scroll; overflow: auto;">
                                                  <div id='availablity'>
                                                      <img src="img/timesc.jpeg" style="opacity: 0.2;width: 100%">


                                                  </div>
                                              </div>
                                          </div>
                                          <div>
                                              <div class="wow fadeInRight" data-wow-delay="0.1s">
                                                  <div style="height: 180px; overflow: auto;">
                                                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3806.76940902119!2d78.35942701382228!3d17.42285038805735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb93f5328eb47f%3A0xfb79a94d665cf81b!2sCPDUMT+Boys+Hostel+Ln%2C+Weaker+Section+Colony%2C+Khajaguda%2C+Manikonda%2C+Hyderabad%2C+Telangana+500032!5e0!3m2!1sen!2sin!4v1510660431833"
                                                              width="100%" height="100" frameborder="0" style="border:0"
                                                              allowfullscreen id="location"></iframe>

                                                  </div>
                                              </div>
                                          </div>
                                      </div>-->


                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-6 ">
                                                <div class="form-group">
                                                    <label>Briefnote</label>
                                                    <textarea id="briefnote" name="briefnote"
                                                              class="form-control input-md"
                                                              value="" placeholder="Brief Note" required></textarea>
                                                    <div class="validation"></div>
                                                </div>
                                            </div>

                                            <input type="hidden" class="form-controlx" name="referralType" value="2"
                                                   required="required" checked
                                                   onclick="javascript:referralTypePatient(2);"/>&nbsp;&nbsp;


                                            <input type="hidden" class="form-controlx" id="payment1"
                                                   name="paymentType" checked value="Cash" required="required"/>&nbsp;&nbsp;

                                            <input type="hidden" class="form-controlx" id="paymentstatus2"
                                                   name="paymentStatus" checked value="0" required="required"/>&nbsp;&nbsp;

                                            <input type="hidden" min="0" class="form-control" id="fee" name="fee"
                                                   value="200">


                                            <!-- <div class="col-xs-6 col-sm-6 col-md-6">
                                                 <div class="form-group">
                                                     <label>Referral Type</label>
                                                     <input type="radio" class="form-controlx" name="referralType" value="1"
                                                            required="required" checked
                                                            onclick="javascript:referralTypePatient(1);"/>&nbsp;&nbsp;Internal
                                                     &nbsp;&nbsp;&nbsp;&nbsp;
                                                     <input type="radio" class="form-controlx" name="referralType" value="2"
                                                            required="required"
                                                            onclick="javascript:referralTypePatient(2);"/>&nbsp;&nbsp;External
                                                 </div>
                                             </div>
                                             <div class="col-xs-6 col-sm-6 col-md-6">
                                                 <div class="form-group">
                                                     <label>Payment Info</label>
                                                     <input type="radio" class="form-controlx" id="payment1"
                                                            name="paymentType" value="Cash" required="required"/>&nbsp;&nbsp;Cash
                                                     &nbsp;&nbsp;&nbsp;&nbsp;
                                                     <input type="radio" class="form-controlx" id="payment2"
                                                            name="paymentType" value="Card" required="required"/>&nbsp;&nbsp;Card
                                                 </div>
                                             </div>
                                             <div class="col-xs-6 col-sm-6 col-md-6">
                                                 <div class="form-group">
                                                     <label>Status</label>
                                                     <input type="radio" class="form-controlx" id="paymentstatus1"
                                                            name="paymentStatus" value="1" required="required"/>&nbsp;&nbsp;Paid
                                                     &nbsp;&nbsp;&nbsp;&nbsp;
                                                     <input type="radio" class="form-controlx" id="paymentstatus2"
                                                            name="paymentStatus" value="0" required="required"/>&nbsp;&nbsp;Unpaid
                                                 </div>
                                             </div>
                                             <div class="col-xs-6 col-sm-6 col-md-6">
                                                 <div class="form-group">
                                                     <label>Amount</label>
                                                     <input type="number" min="0" class="form-control" id="fee" name="fee"
                                                            value="">
                                                 </div>
                                             </div>-->
                                            <div class="col-xs-12 col-sm-6 col-md-6 ">
                                           <center> <input type="submit" value="Book Appointment" class="btn btn-skin btn-block" style="width: 50% font-size:14px; color: white;"></center>


                                </form>
                            </div>
                        </div>

                        </div>

                        <!--ddd-->
                    </div>
                </div>
            </div>
    </section>




    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

    <script>
        // Wait for the DOM to be ready
        $(function () {

            jQuery.validator.addMethod("lettersonly", function (value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            });

            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            $("form#appointment").validate({
                // Specify validation rules
                rules: {

                    doctorId: {
                        required: true,
                    },
                    hospitalId: {
                        required: true,
                    },
                    appointmentCategory:{
                        required: true
                    },

                    appointmentDate: {
                        required: true
                    },
                    appointmentCategory: {
                        required: true
                    },
                    appointmentTime:{
                        required: true
                    }
                },
                // Specify validation error messages
                messages: {
                    doctorId: {
                        required: "Please Select Doctor Id",
                    },
                    appointmentDate: "Please provide a valid Date",
                    appointmentTime:"Please Select Appointment Time",
                    appointmentCategory:"Please Select Appointment Category ",
                    doctorId: "Please Select DoctorId",
                    hospitalId: "Please select HospitalId",
                    specialist: "Please select specialization"
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });

        $("#telephone1").keyup(function () {
            var a = $("#telephone").val();
            var filter = /^[7-9][0-9]{9}$/;

            if (filter.test(a)) {
                return true;
                //alert("valid");
            }
            else {
                alert(a + "Please enter the mobile number starting with 7 or 8 or 9");
            }
        });


    </script>
    <script>

        $('#TestDate').datepicker({
            dateFormat: "mm/dd/yy",
            minDate: new Date()
        });



    window.onload = function () {
            var dateValue = $("#appointmentDate").val();

        };

        function appointmentTypePatient() {
            var dateValue = $("#TestDate").val();
          // alert(dateValue);

            var hid = $("#hospitalId").val();
            var did = $("#doctorId").val();

            if (did != "Select Doctor") {

                var new_appointment_date = dateValue;
                var prev_appointment_date = $("input#prev_appointment_date").val();

                var date1 = new Date(new_appointment_date);
                var date2 = new Date(prev_appointment_date);
                var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                //alert(diffDays);


                if (diffDays <= 15) {
                    $("#paymentTypeInfo").hide();

                    $('input#payment1').attr('required', false);
                    $('input#payment2').attr('required', false);
                    $('input#fee').attr('required', false);

                }
                else {
                    $("#paymentTypeInfo").show();

                    $('input#payment1').attr('required', true);
                    $('input#payment2').attr('required', true);
                    $('input#fee').attr('required', true);

                }


                var BASEURL = "{{ URL::to('/') }}/";
                var status = 1;
                var callurl = BASEURL + 'rest/api/appointmenttimes';


                var d = new Date();
                var h = (d.getHours() < 10 ? '0' : '') + d.getHours();
                var m = (d.getMinutes() < 10 ? '0' : '') + d.getMinutes();
                var s = (d.getSeconds() < 10 ? '0' : '') + d.getSeconds();
                var t = h + ":" + m + ":" + s;
                var timeValue = h + ":" + m;


                $.ajax({
                    url: callurl,
                    type: "get",
                    data: {"date": dateValue, "time": timeValue, "status": status, "doctorId": did, "hospitalId": hid},
                    success: function (data) {
                        console.log(data);

                        if (data.result['result'] == "Doctor Is Not Available") {
                            alert(data.result['result']);
                            var terms = '<option value="">--Choose Time--</option>';
                            $("#appointmentTime").html(terms);
                        } else {

                            var terms = '<option value="">--Choose Time--</option>';
                            $.each(data.result, function (index, value) {
                                terms += '<option value="' + index + '">' + value + '</option>';
                            });
                            $("#appointmentTime").html(terms);
                        }

                    }
                });
            } else {
                alert("Please Select Doctor");
            }


        }


        function getTokenId() {

            var BASEURL = "{{ URL::to('/') }}/";
            var hid = $("#hospitalId").val();
            var date = $("#TestDate").val();
            var did = $("#doctorId").val();
            var type = $("#appointmentCategory").val();

            var status = 1;
            var callurl = BASEURL + 'rest/api/hospital/'+hid+'/doctor/' + did + '/date/'+date+'/tokenId';
           // alert(callurl);
            $.ajax({
                url: callurl,
                type: "get",
                data: {"id": hid, "status": status, "appointmentCategory": type},
                success: function (data) {
                    document.getElementById('token').style.display = 'block';
                    $("#tokenId").html(data);

                }
            });


        }
    </script>



@endsection






