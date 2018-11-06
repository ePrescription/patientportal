@extends('layouts.app')
@section('title','Daiwik Second Opinion')
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
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-skin">
                            <div class="panel-heading">

                                <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Second Opinion
                                    <small></small>
                                </h3>
                            </div>

                            <div class="panel-body">
                                <div id="sendmessage">Your message has been sent. Thank you!</div>
                                <div id="errormessage"></div>
                                @if (session()->has('msg'))
                                    <div class='success' style="color: green">
                                        <b>  {{session()->get('msg')}}</b>

                                    </div>
                                @endif
                                <form action="Savesecondopinion" method="post" id="registration" enctype="multipart/form-data">
                                    {{ csrf_field() }}


                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Select Speciality</label>
                                                <select name="specialist" id="specialist" class="form-control input-md"
                                                        placeholder="Specialist">
                                                    <option value="">Select Speciality</option>
                                                    @foreach ($specialty as $val)
                                                        <option value="{{ $val->id }}">{{ $val->specialty }}</option>
                                                    @endforeach

                                                </select>

                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Select Doctor</label>
                                                <select name="doctor" id="doctor" class="form-control input-md"
                                                        placeholder="Doctor">
                                                    <option value="">Select Doctor</option>
                                                </select>
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Select Hospital</label>
                                                <select name="hospital" id="hospital" class="form-control input-md"
                                                        placeholder="Hospital">
                                                    <option value="">Select Hospital</option>
                                                </select>

                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Select Priority Level</label>
                                                <select name="expectedtime" id="expectedtime"
                                                        class="form-control input-md" placeholder="Hospital">
                                                    <option value="">Select Priority Level</option>
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
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Subject</label>
                                                <input type="text" name="Subject" class="form-control input-md"
                                                       placeholder="Subject" required="">


                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Detailed Description</label>
                                                <textarea name="Message" class="form-control input-md"
                                                          placeholder="Detailed Description" required=""></textarea><br><br>

                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Upload Related Documents</label>


                                                <input type="file" multiple name="image[]" class="form-control input-md"
                                                       placeholder="Please choose a document">


                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label></label>
                                                <input type="hidden" name="questiontype" class="form-control input-md"
                                                       value="Second Opinion"/>
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                    </div>


                                    <input type="submit" style="color: white;" value="Submit" class="btn btn-skin btn-block btn-lg">


                                </form>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">

                            <div id="doctorimg">

                            </div>

                        </div>
                        <div>
                            <div class="wow fadeInRight" data-wow-delay="0.1s">


                                <div id='doctorinfo'>
                                    <img src="img/photo/6.jpg" style="opacity: 0.1;width: 100%">
                                </div>


                            </div>
                        </div>
                    </div>


                    <!--ddd-->
                </div>
            </div>
        </div>
    </section>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script>


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
                        required: true,
                    },
                    expectedtime: {
                        required: true,
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
                    expectedtime:"Select One Priority level",
                    Message:{

                        required:"Please Write SomeThing",
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

