@extends('layouts.app')
@section('title','Daiwik Health Checkup')
@section('styletext')
    <style>
        .error{
            color: red;
        }
    </style>
    <script>

        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
            $("#doctor").change(function () {
                var specialist = $('#specialist').val();
                var doctor_id = $("#doctor").val();
                $.ajax({
                    type: "GET",
                    url: 'loadhospitals',
                    data: {specialist: specialist, doctor_id: doctor_id},
                    dataType: 'json',
                    success: function (msg) {
                        var list = "<option>Select Hospitals</option>";
                        var info = "Name:";
                        var img = "";
                        for (var i = 0; i < msg.length; i++) {
                            list = list + "<option value='" + msg[i]['hospital_id'] + "'>" + msg[i]['hospital_name'] + "</option>";
                            info = "<h5>Doctor's Profile </h5>Name:" + msg[i]['name'] + "<br>Designation :" + msg[i]['designation'] + "<br>Qualification:" + msg[i]['qualifications'] + "<br>Specialty: " + msg[i]['specialty'] + "<br>Experience: " + msg[i]['experience'];
                            img = "<img src='public/doctors/" + msg[i]['doctor_photo'] + "' with='200px' height='200px'>";
                        }

                        $("#hospital").html(list);

                        $("#doctorinfo").html(info);
                        $("#doctorimg").html(img);
                    }
                });

            });


            $("#specialist").change(function () {
                var specialist = $('#specialist').val();
                $.ajax({
                    type: "GET",
                    url: 'loaddoctor',
                    data: {specialist: specialist},
                    dataType: 'json',
                    success: function (msg) {
                        var list = "<option>Select Doctor</option>";
                        for (var i = 0; i < msg.length; i++) {
                            list = list + "<option value='" + msg[i]['doctor_id'] + "'>" + msg[i]['name'] + "</option>";
                        }
                        $("#doctor").html(list);
                    }
                });
            });
        });


    </script>
@endsection
@section('bodycontent')

    <section id="intro" class="intro" style="margin-bottom:50px;">
        <div class="intro-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-skin">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Health Checkups
                                    <small></small>
                                </h3>
                            </div>

                            <div class="panel-body">
                                <div id="sendmessage">Your message has been sent. Thank you!</div>
                                <div id="errormessage"></div>
                                @if (session()->has('msg'))
                                    <div class='success'>
                                        <b style="color:green;">  {{session()->get('msg')}}</b>
                                    </div>
                                @endif
                                <div class="row">
                                    @foreach($healthcheckups as $checkup)
                                        <?php
                                        $packageId = null;
                                        $packageId = $checkup->id;
                                        ?>
                                        <div class="col-xs-6 col-sm-6 col-md-4">
                                            <form action="bookhealthcheckup" method="post">
                                                <div class="form-group">
                                                    <h6>{{$checkup->package_name}}</h6>
                                                    <ul>
                                                        @foreach($labtest as $test)
                                                            @if($test->package_id == $checkup->id)
                                                                <li>{{$test->test_name}}</li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <input type="hidden" name="packageId" value="{{$packageId}}"/>
                                                <input type="hidden" name="packageName" value="{{$checkup->package_name}}"/>
                                                <input class="btn btn-info" type="submit" value="Book" />
                                            </form>
                                        </div>
                                    @endforeach
                                </div>

                                    {{ csrf_field() }}

                                    <input type="submit" value="Submit" class="btn btn-skin btn-block btn-lg">
                            </div>
                        </div>
                    </div>

                    <!--ddd-->
                </div>
            </div>
        </div>
    </section>
    <script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>

@endsection

