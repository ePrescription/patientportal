@extends('layouts.app')
@section('title','Daiwik Pharmacy Pickup')
@section('styletext')
<script>
    $('#datepicker3').datepicker({
        dateFormat: "mm/dd/yy",
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
                    for (var i = 0; i < msg.length; i++) {
                        list = list + "<option value='" + msg[i]['hospital_id'] + "'>" + msg[i]['hospital_name'] + "</option>";
                    }
                    $("#hospital").html(list);
                }
            });

        });

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


        $("#subtest").change(function () {

            var testid = $('#subtest').val();
            $.ajax({
                type: "GET",
                url: 'loadlabs',
                data: {testid: testid},
                dataType: 'json',
                success: function (msg) {
                    var list = "<option>Select Lab</option>";
                    for (var i = 0; i < msg.length; i++) {
                        list = list + "<option value='" + msg[i]['lab_id'] + "'>" + msg[i]['name'] + " Address: " + msg[i]['address'] + "</option>";

                    }
                    $("#labs").html(list);
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
            var doctor_id = $("#doctor").val();
            var hospital = $("#hospital").val();
            $.ajax({
                type: "get",
                url: 'loadAddress',
                data: {specialist: specialist, doctor_id: doctor_id, hsp_id: hospital},
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

                    var list = "<table cellspacing='30px' style='color:white;font-size:13px;'> <tr><th>Day</th> <th>Morning</th><th> Evening</th></tr>";
                    for (var i = 0; i < msg.length; i++) {
                        list = list + "<tr><td>" + msg[i]['day'] + "</td><td> " + msg[i]['morning'] + "</td><td>" + msg[i]['evening'] + "</td></tr> ";

                    }

                    $("#availablity").html(list + "</table>");
                }
            });


        });

        $("#hospital_id").change(function () {
            var hospital_id = $('#hospital_id').val();

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
                        var details = "<font style='color:black'> Name :" + msg[i]['name'] + "<br> Address :" + msg[i]['address'] + " <br>Telephone:" + msg[i]['telephone'] + " Mail:" + msg[i]['email'] + "</font>";
                        $('#pharmacyaddress').html(details)
                    }

                    $("#pharmacy_id").html(list);
                }
            });
        });


        $("#datepicker1").change(function () {
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

    $(function () {

        var pickerOpts = {
            format: 'd-m-Y H:i:s',
            //timepicker:true,
            // datepicker:true,
            changeMonth: true,
            changeYear: true,
            // showSeconds: true,
            showMonthAfterYear: true,
        };


       // $("#datepicker3").datetimepicker(pickerOpts);
        // $("#toDate").datetimepicker(pickerOpts1);

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

                            <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Pharmacy Pickup  <small></small></h3>
                        </div>

                        <div class="panel-body">
                            <div id="sendmessage">Your message has been sent. Thank you!</div>
                            <div id="errormessage"></div>
                            @if (session()->has('msg'))
                            <div class='success'>
                                <b>  {{session()->get('msg')}}</b>

                            </div>
                            @endif
                            <form action="makepharmacyappointment" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Select Hospital</label>
                                            <select name="hospital_id" id="hospital_id" class="form-control input-md" placeholder="Hospital" >
                                                <option>Select Hospital</option>
                                                @foreach ($hospitals as $val)

                                                <option value ="{{ $val['hospital_id'] }}">{{ $val['hospital_name'] }}</option>


                                                @endforeach        

                                            </select>
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Select Pharmac</label>
                                            <select name="pharmacy_id" id ="pharmacy_id" class="form-control input-md" placeholder="Pharmacy">
                                                <option>Select Pharmacy</option>
                                            </select>
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Enter Doctor Name</label>
                                            <input type='text' class="form-control input-md" id="doctorname" name="doctorname"  value="" placeholder="Doctor Name" >



                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Brief Note</label>
                                            <textarea  id="briefnote" name="briefnote" class="form-control input-md"  value="" placeholder="Brief Note" required=""></textarea>

                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Req Date and Time of pick up</label>
                                            <input  id="datepicker3" name="date" name="Text" type="date"  class="form-control input-md"
                                                   placeholder="Req Date" required=""><br><br><br>



                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Upload Prescription</label>

                                            <input type="file" multiple name="image[]" class="form-control input-md" placeholder="Please choose a document">

                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" value="Pickup" class="btn btn-skin btn-block btn-lg">


                            </form>
                        </div>



                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">
 <div style="height: 200px;overflow-y: scroll; overflow: auto;">
                        <h5>Pharmacy Address </h5>
                        
                        <div id='pharmacyaddress'>
                                    <img src="img/slides/slide1/bg.jpg" style="opacity: 0.2;width: 100%">
                        </div>
 </div>
                    </div>
                    <div  >
                        <div class="wow fadeInRight" data-wow-delay="0.1s">
                            <ul class="lead-list">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3806.76940902119!2d78.35942701382228!3d17.42285038805735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb93f5328eb47f%3A0xfb79a94d665cf81b!2sCPDUMT+Boys+Hostel+Ln%2C+Weaker+Section+Colony%2C+Khajaguda%2C+Manikonda%2C+Hyderabad%2C+Telangana+500032!5e0!3m2!1sen!2sin!4v1510660431833" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen id="location3"></iframe>
                            </ul>

                        </div>
                    </div>
                </div>


                <!--ddd-->
            </div>
        </div>
    </div>
</section>




@endsection

