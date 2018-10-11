@extends('layouts.app')
@section('title','Daiwik Book Health Checkup')
@section('styletext')
<style>
    .error{
        color: red;
    }
</style>
<script>
    $('#datepicker3').datepicker({
        dateFormat: "mm/dd/yy"
    });

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

                            <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Book Health Checkup
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
                            <form action="savehealthcheckup" method="post" id="registration" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Package Name</label>
                                            <input type="text" name="packageName" class="form-control input-md" placeholder="Patient Name" value="{{$packageName}}" readonly>
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <input type="text" name="patientName" class="form-control input-md" placeholder="Patient Name" required="">
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Referral</label>
                                            <input type="text" name="referral" class="form-control input-md" placeholder="Referral Doctor/Self" required="">
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Email Id</label>
                                            <input type="email" name="emailId" class="form-control input-md" placeholder="Email" required="">
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="number" name="mobile" class="form-control input-md" placeholder="Mobile" required="">
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Hospital / Diagnostic Center</label>
                                            <select name="hospital" id="hospital" class="form-control input-md" required>
                                                <option value="">Select Hospital</option>
                                                <option value="Daiwik 1">Daiwik 1</option>
                                                <option value="Daiwik 2">Daiwik 2</option>
                                                <option value="Daiwik 3">Daiwik 3</option>
                                                <option value="LabGlobal">LabGlobal</option>
                                                <option value="LabApollo ">LabApollo </option>
                                                <option value="Lab Mallar">Lab Mallar</option>
                                            </select>
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input  id="datepicker3" name="date" type="date"  class="form-control input-md" placeholder="Req Date" required=""><br><br><br>
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" value="{{$packageId}}" name="packageId" />
                                <input type="submit" value="Submit" class="btn btn-skin btn-block btn-lg">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>

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
                patientName: "required",
                referral: "required",
                hospital: {
                    required: true
                },
                date: {
                    required: true
                },
                emailId: {
                    required: true
                },
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10
                }

            },
            // Specify validation error messages
            messages: {
                patientName: "Please Enter Patient Name",
                referral: "Please Enter the Referral Person",
                hospital: "Please Choose Hospital",
                date:"Select the date",
                emailId: "Please Enter the Email",
                mobile:{
                    required:"Please Enter the Mobile Number",
                    minlength: "Mobile Number should be 10 characters long",
                    maxlength: "Mobile Number should be 10 characters long"
                }
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

