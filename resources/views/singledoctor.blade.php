@extends('layouts.app')
@section('title','Daiwik Doctors Info')
@section('styletext')

    <style>


        .error {
            color: red;
        }

        .panel-default1 {
            border-color: #ddd;
            border-left-color: purple;
            border-left-style: groove;
            border-left-width: 10px;
        }

        .panel-default1 > .panel-heading {
            color: #333;
            background-color: #f5f5f5;
            border-left-color: purple;
            border-left-style: groove;
            border-left-width: 10px;
        }

        .panel-default1 > .panel-heading + .panel-collapse > .panel-body {
            border-top-color: #ddd;
        }

        .panel-default1 > .panel-heading .badge {
            color: #f5f5f5;
            background-color: #333;
        }

        .panel-default1 > .panel-footer + .panel-collapse > .panel-body {
            border-bottom-color: #ddd;
        }

        .shadow {
            box-shadow: 0 10px 10px #999;
        }

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


    </style>


    <script>
        $(function () {

            var pickerOpts = {
                format: 'd-m-Y',
                //timepicker:true,
                // datepicker:true,
                changeMonth: true,
                changeYear: true,
                // showSeconds: true,
                showMonthAfterYear: true
            };


            $("#datepicker1").datetimepicker(pickerOpts);
            // $("#toDate").datetimepicker(pickerOpts1);

        });
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });

            $("#datepicker11").change(function () {

                var doctor_id = $("#doctor").val();
                var hospital = $("#hospital1").val();
                var date = $("#datepicker1").val();

                $.ajax({
                    type: "get",
                    url: 'timeslots',
                    data: {doctor_id: doctor_id, hsp_id: hospital, date: date},
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


            });

        });
    </script>
    <style>
        .alpha60 {
            /* Fallback for web browsers that don't support RGBa */
            background: rgba(255, 255, 255, 0.25);
            overflow-y: auto;

            background: rgba(0, 0, 0, 0.40);
            border: 0;
            color: #fff;
        }


    </style>
@endsection
@section('bodycontent')



    <!--display strar-->
    <center>
        <br>
        @if (session()->has('msg'))
            <div class='success'>
                <b style="color: green">  {{session()->get('msg')}}</b>

            </div>
        @endif<br></center>
    <div class="container">
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">

                    <div class="preview col-md-6">

                        <div class="preview-pic tab-content">

                            <!-- doctor info -->
                            @foreach ($doctors as $doctor)
                                @if(is_null($doctor->doctor_photo)||is_null($doctor->doctor_photo))
                                    <div class="tab-pane active" id="pic-1">
                                        <center><img src="/../images/steth.jpg" alt="" class="shadow"/></center>
                                    </div>

                                @else
                                    <center>
                                        <div class="tab-pane active" id="pic-1"><img
                                                    src="public/doctors/{{$doctor->doctor_photo}}" class="shadow"
                                                    style="width: 200px;height: 200px;"></div>

                                        <div class="blog-info-w3layouts">
                                            <p>{{$doctor->name}}</p>

                                            <p>{{$doctor->designation}}</p>
                                            <p class="para-wthree">{{$doctor->qualifications}}.</p>
                                            <p class="para-wthree">{{$doctor->address}}.</p>


                                        </div>
                                    </center>
                            @endif

                        @endforeach
                        <!-- info end -->
                        </div>

                    </div>

                    <div class="details col-md-6" style="max-height: 350px;overflow-y: scroll;" class="panel-default1">


                        @if(is_null($hospital)||is_null($doctorinfo))

                        @else
                            <br>



                            <?php
                            $x = "";
                            $y = "";
                            ?>

                            @foreach ($doctorinfo as $dcinfo)

                                <?php
                                if ($x == "") {
                                $x = $dcinfo->hospital_name;
                                ?>
                                <h3>
                                    <center>{{$dcinfo->hospital_name}}</center>
                                </h3>

                                <?php
                                }
                                if ($x != $dcinfo->hospital_name) {
                                $x = $dcinfo->hospital_name;
                                ?>
                                <h3>
                                    <center>{{$dcinfo->hospital_name}}</center>
                                </h3>


                                <?php } ?>

                            <!--   <div class="panel panel-default1 text-center">
                        <h3><div class="panel-title">{{$dcinfo->day}}</div></h3>
                        <p>Morning {{$dcinfo->morning}} </p>
                        <p>Evening {{$dcinfo->evening}} </p>
                    </div>-->



                            @endforeach


                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--display end--><br>





    <!-- /Section: boxes -->
    <section id="intro" class="intro" style="margin-bottom:100px;">
        <div class="intro-content" style="padding:0px 0px 0px">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-skin">
                            <div class="panel-heading">

                                <h3 class="panel-title"><span class="fa fa-question"></span>Ask a Question?
                                    <small></small>
                                </h3>
                            </div>

                            <div class="panel-body">
                                <div id="sendmessage">Your message has been sent. Thank you!</div>
                                <div id="errormessage"></div>

                                <form action="askquestsendmail" method="post" id="registration"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Select Hospital</label>
                                                <input class="name" type="hidden" value="{{ $doctors[0]->doctor_id}}"
                                                       name='doctor' id='doctor'/>

                                                <input type="hidden" class="form-control" name="specialist" id="specialist" value="{{ $doctors[0]->id }}"/>


                                                <select class="form-control input-md name" name="hospital" id="hospital"
                                                        placeholder="Hospital" style="width:100%;">
                                                    <option value="">Select Hospital</option>
                                                    @foreach ($hospital as $val)
                                                        <option value="{{ $val['hospital_id'] }}">{{ $val['hospital_name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Select Priority</label>
                                                <select class="form-control input-md name" style="width:100%;"
                                                        name="expectedtime" id="expectedtime" placeholder="Hospital">
                                                    <option value="">Select Priority</option>
                                                    <option value="1">Emergency</option>
                                                    <option value="2">Immediate</option>
                                                    <option value="3">Normal</option>
                                                    <option value="4">Medium</option>

                                                </select>
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Subject</label>
                                                <input style="width:100%;" class="form-control input-md name"
                                                       type="text" name="Subject" placeholder="Subject" required="">
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Message</label>
                                                <textarea style="width:100%;" class="form-control input-md name"
                                                          name="Message" placeholder="Message" required=""></textarea>
                                                <div class="validation"></div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Upload Related Documents</label>

                                                <input style="width:100%;" type="file" multiple name="image[]"
                                                       class="form-control input-md name"
                                                       placeholder="Please choose a document">
                                                <input style="width:100%;" class="form-control input-md name"
                                                       type="hidden" name="questiontype" value="Ask A Question"/>
                                                <div class="validation"></div>
                                            </div>
                                        </div>


                                    </div>

                                    <input type="submit" value="submit" style="color: white;" class="btn btn-skin btn-block btn-lg">


                                </form>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
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

                                <form action="makeappointment" method="post" id="appointment">
                                    {{ csrf_field() }}
                                    <div class="row">

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
                                                <label>Select Hospital</label>
                                                <input type="hidden" value="{{ $doctors[0]->doctor_id}}" name='doctorId'
                                                       id='doctorId'/>

                                                <select class="form-control name" style="width:100%;" name="hospitalId"
                                                        id="hospitalId" class="form-control name" placeholder="Hospital"
                                                        onchange="javascript:appointmentTypePatient(); ">
                                                    <option value="">Select Hospital</option>
                                                    @foreach ($hospital as $val)
                                                        <option value="{{ $val['hospital_id'] }}">{{ $val['hospital_name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="validation"></div>
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
                                                <label>Appointment Time<span class="red">*</span></label>
                                                <select class="form-control" name="appointmentTime" id="appointmentTime"
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


                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Briefnote</label>
                                                <textarea style="width:100%;" id="briefnote"
                                                          name="briefnote" class="form-control"
                                                          placeholder="Brief Note" required=""></textarea>
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--       <div class="col-xs-6 col-sm-6 col-md-6">
                                               <div class="form-group">
                                                   <label>Appointment Date and Time</label>
                                                   <input style="width:100%;" class="name" id="datepicker1" name="date"
                                                          name="Text" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {
                                                            ;
                                                        }" placeholder="Appointment Date and Time" required="">


                                                   <div class="validation"></div>
                                               </div>
                                           </div>-->
                                    <div class="col-xs-6 col-sm-6 col-md-6" id="token" style="display: none">
                                        <div class="form-group">


                                            <b>Your Token ID:</b>
                                            <p name="tokenId" id="tokenId" required="required" readonly
                                               style="font-size: 20px;color: blue;"></p>

                                        </div>
                                    </div>
                                    <input type="hidden" value="{{Session::get('patient_id')}}" name='patientId'
                                           id='patientId'/>

                                    <div style="width:100%;" class="name" id="timeslots"></div>
                                    <input type="submit" value="Book Appointment" style="color: white;" class="btn btn-skin btn-block btn-lg">


                                </form>
                            </div>
                        </div>


                    </div>
                </div>
                <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <link rel="stylesheet" href="/resources/demos/style.css">
                <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <script>
                    $('#TestDate').datepicker({
                        dateFormat: "mm/dd/yy"
                    });

                </script>


                <!--ddd-->
            </div>
        </div>
        </div>
    </section>


    <script>
        window.onload = function () {
            var dateValue = $("#appointmentDate").val({minDate: new Date()});

        };

        function appointmentTypePatient() {
            var dateValue = $("#TestDate").val();
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
            var callurl = BASEURL + 'rest/api/hospital/' + hid + '/doctor/' + did + '/date/' + date + '/tokenId';
            //alert(callurl);
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




    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js"
            type="text/javascript"></script>


    <script>
        // Wait for the DOM to be ready
        $(function () {

            jQuery.validator.addMethod("lettersonly", function (value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            });

            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            $("form#registration").validate({
                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    hospital: "required",
                    specialist: "required",
                    doctor: {
                        required: true
                    },
                    expectedtime: {
                        required: true
                        // Specify that email should be validated
                        //by the built-in "email" rule

                    },

                    Message: {
                        required: true,
                        minlength: 6,
                        maxlength: 300
                    }

                },
                // Specify validation error messages
                messages: {
                    doctor: "Please choose Doctor",
                    hospitalId: "Please choose Hospital",
                    specialist: "Please choose Specialization Type",
                    expectedtime: "Select One Priority level",
                    Message: {

                        required: "Please Write SomeThing",
                        minlength: "Meaage Atleast 6 characters long",
                        maxlength: "Meaage Should be less Than 300 characters long"
                    },

                    age: "Please provide a valid age"

                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function (form) {
                    form.submit();
                }
            });


            $("form#appointment").validate({
                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    hospitalId: "required",
                    doctorId: {
                        required: true
                    },
                    AppointmentType: {
                        required: true
                        // Specify that email should be validated
                        //by the built-in "email" rule

                    },

                    appointmentTime: {
                        required: true
                    }

                },
                // Specify validation error messages
                messages: {
                    doctorId: "Please choose Doctor",
                    hospitalId: "Please choose Hospital",
                    AppointmentType: "Please Select AppointmentType",
                    appointmentTime: "Please Select appointmentTime"
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

@endsection

