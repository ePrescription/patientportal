@extends('layouts.app')
@section('title','Daiwik Welcome')
@section('styletext')

@section('bodycontent')

    <section id="intro" class="intro" style="margin-bottom:50px;">
        <div class="intro-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-skin">
                            <div class="panel-heading">

                                <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Edit Profile
                                    <small></small>
                                </h3>
                            </div>

                            <div class="panel-body">
                                <div id="sendmessage">Your message has been sent. Thank you!</div>
                                <div id="errormessage"></div>
                                @if (session()->has('msg'))
                                    <div class='success' style="color: green;">
                                        <b>  {{session()->get('msg')}}</b>

                                    </div>
                                @endif

                                <form action="SaveEditProfile" method="post" id="editprofile"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                    <img src="public/storage/{{$patientProfile->patient_photo}}" with="100px" height="160px">

                                                    {{--<img src="askquestion/{{$patientProfile->patient_photo}}" alt="Blank">--}}

                                                <div class="validation"></div>
                                            </div>
                                        </div>



                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" id="name" placeholder="Username" value="{{$patientProfile->name}}"/>

                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" readonly id="email" placeholder="Email" value="{{$patientProfile->email}}" required=""/>

                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <input type="text" name="telephone" id="telephone" placeholder="MobileNumber" value="{{$patientProfile->telephone}}"/>

                                                <div class="validation"></div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Profile Photo</label>
                                                <input type="file" class="form-controlx" name="patientPhoto" id="patientPhoto" placeholder="patientPhoto"/>

                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <input type="radio" class="form-controlx" id="gender1" name="gender" value="1" @if($patientProfile->gender==1) checked  @endif />&nbsp;&nbsp;Male
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="radio" class="form-controlx" id="gender2" name="gender" value="2" @if($patientProfile->gender!=1) checked  @endif/>&nbsp;&nbsp;Female

                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>DateOfBirth</label>
                                                <input name="dob"  onblur="calculateAge(this.value)" id="dob1"   type="text" value="2018/01/01" style="line-height: 20px;" placeholder="Select DateofBirth">

                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>AGE</label>
                                                <br>
                                                <input type="text"  name="age" id="age" placeholder="Age" readonly/>

                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <input type="hidden" name="patientId" id="patientId" placeholder="Age" value="{{Session::get('patient_id')}}" required=""/>

                                                <div class="validation"></div>
                                            </div>
                                        </div>

                                    <div class="col-xs-12 col-sm-7 col-md-8">
                                        <input type="submit" value="Submit" style="color: white;" class="btn btn-skin btn-block btn-lg">
                                    </div>

                                    </div>
                                </form>
                            </div>

                        </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">


                            </div>


                            <div class="wow fadeInRight" data-wow-delay="0.1s">

                                <div id='doctorinfo'>
                                    <img src="img/photo/6.jpg" style="opacity: 0.1;width: 100%">
                                </div>


                            </div>

                    </div>


                    <!--ddd-->
                </div>
            </div>
        </div>
    </section>
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="js/jquery.js"></script>-->


    <!-- Vendor Scripts -->

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js"
            type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <link rel="stylesheet" href="./css/bootstrap-material-datetimepicker.css"/>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap-material-datetimepicker.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{--<link rel="stylesheet"--}}
    {{--href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/bootstrap-material-design.min.css"/>--}}


    <script>
        $('#dob1').bootstrapMaterialDatePicker
        ({
            time: false,
            clearButton: false,
            format: 'YYYY/MM/DD',


        });


        function getAge(date) {
            var now = new Date();
            var diff_ms = Date.now() - date.getTime();
            var age_dt = new Date(diff_ms);
            return Math.abs(age_dt.getUTCFullYear() - 1970);
        };

        function calculateAge(dob) {

            var dateofbirth = $("#dob").val();
            // alert(dob+""+dateofbirth);
            var dateOfBirth = new Date(dob + " 00:00:00");
            var age = getAge(new Date(dateOfBirth.getFullYear(), dateOfBirth.getMonth(), dateOfBirth.getDay()));
            // calculate age
            //alert(age);
            var now = new Date();
            var start = new Date(dateofbirth),
                end = new Date(now);
            //var x = Date.getFormattedDateDiff(start, end);
            //alert(age);
            // $('#age').val(age);
            $("#age").val(age).prop('readOnly', true);

        }


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
                    //hospitalId: "required",
                    // role: "required",
                    name: {
                        required: true,
                        lettersonly: true
                    },
                    email: {
                        required: true,
                        // Specify that email should be validated
                        //by the built-in "email" rule
                        email: true
                    },
                    telephone: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10
                    },
                     age: {
                        // required: true,
                         number: true,
                         minlength: 1,
                          maxlength: 3
                     }

                },
                // Specify validation error messages
                messages: {
                    // role: "Please choose role",
                    // hospitalId: "Please choose Hospital",
                    name: {
                        required: "Please enter your name",
                        lettersonly: "Your name must be characters"
                    },
                    email: "Please enter a valid email address",
                    telephone: {
                        required: "Please provide a valid mobile number",
                        minlength: "Your mobile number must be 10 characters long",
                        maxlength: "Your mobile number must be 10 characters long"
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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    @endsection

    </body>

    </html>
