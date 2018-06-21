@extends('layouts.app')
@section('title','Daiwik Diagnostics')
@section('styletext')


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
<!-- jQuery 2.1.4 -->
<script href="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>

    $(function () {

    var pickerOpts = {
    format: 'Y-m-d',
            //timepicker:true,
            // datepicker:true,
            changeMonth: true,
            changeYear: true,
            // showSeconds: true,
            showMonthAfterYear: true,
    };

    $("#datepicker2").datetimepicker(pickerOpts);
   // $("#input#TestTIme").datetimepicker(pickerOpts1);
        $("input#TestTime").timepicker({
            timeFormat: 'HH:mm:ss',
            interval: 60,
            defaultTime: '{{date('H:i:s')}}',
            startTime: '00:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

    });
    jQuery(document).ready(function ($) {
    $(".scroll").click(function (event) {
    event.preventDefault();
    $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
    });


        function UpdateTestDates(dateValue) {
            alert();

            for (var i = 0; i < $('input#TestDates').length; i++) {
                $('input#TestDates').val(dateValue);
            }

        }

        function UpdateTestTimes(timeValue) {
            alert();
            for (var i = 0; i < $('input#TestTimes').length; i++) {
                $('input#TestTimes').val(timeValue);
            }

        }






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




    
            function ajaxloadblooddetails() {

            $("#patientblooddiv").html("LOADING...");
            var BASEURL = "{{ URL::to('/') }}/";
            var status = 1;
            var callurl = BASEURL + 'bloodtestsentries';
           // alert(callurl);
           
            
            $.ajax({
            url: callurl,
                    type: "get",
                    data: {"status": status},
                    success: function (data) {
                    $("#patientblooddiv").html(data);
                  //  alert(data);
                    }
            });
            
            }

    function ajaxloadmotiondetails() {

    $("#patientmotiondiv").html("LOADING...");
    var BASEURL = "{{ URL::to('/') }}/";
    var status = 1;
    var callurl = BASEURL + 'motiontestsentries';
   
    $.ajax({
    url: callurl,
            type: "get",
            data: {"status": status},
            success: function (data) {
            $("#patientmotiondiv").html(data);
           // alert(data);
            }
    });
   

    }

    function ajaxloadurinedetails() {

    $("#patienturinediv").html("LOADING...");
    var BASEURL = "{{ URL::to('/') }}/";
    var status = 1;
    var callurl = BASEURL + 'urinetestsentries';
    
    $.ajax({
    url: callurl,
            type: "get",
            data: {"status": status},
            success: function (data) {
            $("#patienturinediv").html(data);
            //alert(data);
            }
    });
    
    
    }

    function ajaxloadultradetails() {

    $("#patientultradiv").html("LOADING...");
    var BASEURL = "{{ URL::to('/') }}/";
    var status = 1;
    var callurl = BASEURL + 'ultrasoundtestsentries';
    
    $.ajax({
    url: callurl,
            type: "get",
            data: { "status": status},
            success: function (data) {
            $("#patientultradiv").html(data);
           // alert(data);
            }
    });
    

    }

    function ajaxloadscandetails() {

    $("#patientscandiv").html("LOADING...");
    var BASEURL = "{{ URL::to('/') }}/";
    var status = 1;
    var callurl = BASEURL + 'scantestsentries';
    
    $.ajax({
    url: callurl,
            type: "get",
            data: { "status": status},
            success: function (data) {
            $("#patientscandiv").html(data);
           // alert(data);
            }
    });
    
    }

    function ajaxloaddentaldetails() {

    $("#patientdentaldiv").html("LOADING...");
    var BASEURL = "{{ URL::to('/') }}/";
    var status = 1;
    var callurl = BASEURL + 'dentaltestsentries';
    
    $.ajax({
    url: callurl,
            type: "get",
            data: {"status": status},
            success: function (data) {
            $("#patientdentaldiv").html(data);
            //alert(data);
            }
    });
    

    }

    function ajaxloadxraydetails() {

    $("#patientxraydiv").html("LOADING...");
    var BASEURL = "{{ URL::to('/') }}/";
    var status = 1;
    var callurl = BASEURL + 'xraytestsentries';
    
    $.ajax({
    url: callurl,
            type: "get",
            data: { "status": status},
            success: function (data) {
            $("#patientxraydiv").html(data);
            //alert(data);
            }
    });
    

    }

    function ajaxloadbloodform(did, hid, pid) {
    $("#patientblooddiv").html("LOADING...");
    var BASEURL = "{{ URL::to('/') }}/";
    var status = 1;
    var callurl = BASEURL + 'doctor/' + did + '/hospital/' + hid + '/patient/' + pid + '/add-lab-bloodtests';
    $.ajax({
    url: callurl,
            type: "get",
            data: {"id": pid, "status": status},
            success: function (data) {
            $("#patientblooddiv").html(data);
            $("#TestDate").datepicker({ dateFormat: 'yy-mm-dd', minDate: new Date() });
            $("input#TestTime").timepicker({
            timeFormat: 'HH:mm:ss',
                    interval: 60,
                    defaultTime: '{{date('H:i:s')}}',
                    startTime: '00:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
            });
            }
    });
    }

    function ajaxloadmotionform(did, hid, pid) {
    $("#patientmotiondiv").html("LOADING...");
    var BASEURL = "{{ URL::to('/') }}/";
    var status = 1;
    var callurl = BASEURL + 'doctor/' + did + '/hospital/' + hid + '/patient/' + pid + '/add-lab-motiontests';
    $.ajax({
    url: callurl,
            type: "get",
            data: {"id": pid, "status": status},
            success: function (data) {
            $("#patientmotiondiv").html(data);
            $("#TestDate").datepicker({ dateFormat: 'yy-mm-dd', minDate: new Date() });
            $("input#TestTime").timepicker({
            timeFormat: 'HH:mm:ss',
                    interval: 60,
                    defaultTime: '{{date('H:i:s')}}',
                    startTime: '00:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
            });
            }
    });
    }

    function ajaxloadurineform(did, hid, pid) {
    $("#patienturinediv").html("LOADING...");
    var BASEURL = "{{ URL::to('/') }}/";
    var status = 1;
    var callurl = BASEURL + 'doctor/' + did + '/hospital/' + hid + '/patient/' + pid + '/add-lab-urinetests';
    $.ajax({
    url: callurl,
            type: "get",
            data: {"id": pid, "status": status},
            success: function (data) {
            $("#patienturinediv").html(data);
            $("#TestDate").datepicker({ dateFormat: 'yy-mm-dd', minDate: new Date() });
            $("input#TestTime").timepicker({
            timeFormat: 'HH:mm:ss',
                    interval: 60,
                    defaultTime: '{{date('H:i:s')}}',
                    startTime: '00:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
            });
            }
    });
    }

    function ajaxloadultraform(did, hid, pid) {
    $("#patientultradiv").html("LOADING...");
    var BASEURL = "{{ URL::to('/') }}/";
    var status = 1;
    var callurl = BASEURL + 'doctor/' + did + '/hospital/' + hid + '/patient/' + pid + '/add-lab-ultrasoundtests';
    $.ajax({
    url: callurl,
            type: "get",
            data: {"id": pid, "status": status},
            success: function (data) {
            $("#patientultradiv").html(data);
            $("#TestDate").datepicker({ dateFormat: 'yy-mm-dd', minDate: new Date() });
            $("input#TestTime").timepicker({
            timeFormat: 'HH:mm:ss',
                    interval: 60,
                    defaultTime: '{{date('H:i:s')}}',
                    startTime: '00:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
            });
            }
    });
    }

    function ajaxloadscanform(did, hid, pid) {
    $("#patientscandiv").html("LOADING...");
    var BASEURL = "{{ URL::to('/') }}/";
    var status = 1;
    var callurl = BASEURL + 'doctor/' + did + '/hospital/' + hid + '/patient/' + pid + '/add-lab-scantests';
    $.ajax({
    url: callurl,
            type: "get",
            data: {"id": pid, "status": status},
            success: function (data) {
            $("#patientscandiv").html(data);
            $("#TestDate").datepicker({ dateFormat: 'yy-mm-dd', minDate: new Date() });
            $("input#TestTime").timepicker({
            timeFormat: 'HH:mm:ss',
                    interval: 60,
                    defaultTime: '{{date('H:i:s')}}',
                    startTime: '00:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
            });
            }
    });
    }

    function ajaxloaddentalform(did, hid, pid) {
    $("#patientdentaldiv").html("LOADING...");
    var BASEURL = "{{ URL::to('/') }}/";
    var status = 1;
    var callurl = BASEURL + 'doctor/' + did + '/hospital/' + hid + '/patient/' + pid + '/add-lab-dentaltests';
    $.ajax({
    url: callurl,
            type: "get",
            data: {"id": pid, "status": status},
            success: function (data) {
            $("#patientdentaldiv").html(data);
            $("#TestDate").datepicker({ dateFormat: 'yy-mm-dd', minDate: new Date() });
            $("input#TestTime").timepicker({
            timeFormat: 'HH:mm:ss',
                    interval: 60,
                    defaultTime: '{{date('H:i:s')}}',
                    startTime: '00:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
            });
            }
    });
    }

    function ajaxloadxrayform(did, hid, pid) {
    $("#patientxraydiv").html("LOADING...");
    var BASEURL = "{{ URL::to('/') }}/";
    var status = 1;
    var callurl = BASEURL + 'doctor/' + did + '/hospital/' + hid + '/patient/' + pid + '/add-lab-xraytests';
    $.ajax({
    url: callurl,
            type: "get",
            data: {"id": pid, "status": status},
            success: function (data) {
            $("#patientxraydiv").html(data);
            $("#TestDate").datepicker({ dateFormat: 'yy-mm-dd', minDate: new Date() });
            $("input#TestTime").timepicker({
            timeFormat: 'HH:mm:ss',
                    interval: 60,
                    defaultTime: '{{date('H:i:s')}}',
                    startTime: '00:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
            });
            }
    });
    }

    function printDiv()
    {
    var divToPrint = document.getElementById('DivIdToPrint');
    var newWin = window.open('', 'Print-Window');
    newWin.document.open();
    newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
    newWin.document.close();
    setTimeout(function(){newWin.close(); }, 10);
    }

    function UpdateTestDates(dateValue) {

    for (var i = 0; i < $('input#TestDates').length; i++) {
    $('input#TestDates').val(dateValue);
    }

    }

    function UpdateTestTimes(timeValue) {

    for (var i = 0; i < $('input#TestTimes').length; i++) {
    $('input#TestTimes').val(timeValue);
    }

    }
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
   function loaddoctor() {
       var hospital_id = $("#hospitalId").val();

       var BASEURL = "{{ URL::to('/') }}/";
       var status = 1;
       var callurl = BASEURL + 'loaddoctorlab';

       $.ajax({
           type: "GET",
           url: callurl,
           data: {hospital_id: hospital_id},
           dataType: 'json',
           success: function (msg) {

               var list = "<option>Select Hospitals</option>";
               for (var i = 0; i < msg.length; i++) {
                   list = list + "<option value='" + msg[i]['doctor_id'] + "'>" + msg[i]['name'] + "</option>";
               }
               $("#doctorId").html(list);
           }
       });

   }


</script>

@endsection
@section('bodycontent')
<section id="intro" class="intro" style="margin-bottom:50px;">
    <div class="intro-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="panel panel-skin">
                        <div class="panel-heading">

                            <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Book  Diagnostics appointment<small></small></h3>
                        </div>

                        <div class="panel-body" style="width: 100%;">
                            <div id="sendmessage">Your message has been sent. Thank you!</div>
                            <div id="errormessage"></div>
                            @if (session()->has('msg'))
                            <div class='success'>
                                <b style="color: green">  {{session()->get('msg')}}</b>

                            </div>
                            @endif

                                {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-12">



                                            <ul class="nav nav-tabs navtab-bg">
                                                <li class="active">
                                                    <a href="#blood" data-toggle="tab" aria-expanded="true" onclick="javascript:ajaxloadblooddetails();">
                                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                        <span class="hidden-xs">Blood</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="#motion" data-toggle="tab" aria-expanded="false" onclick="javascript:ajaxloadmotiondetails();">
                                                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                                                        <span class="hidden-xs">Motion</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="#urine" data-toggle="tab" aria-expanded="false" onclick="javascript:ajaxloadurinedetails();">
                                                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                                        <span class="hidden-xs">Urine</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="#ultra" data-toggle="tab" aria-expanded="false" onclick="javascript:ajaxloadultradetails();">
                                                        <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                                        <span class="hidden-xs">Ultra Sound</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="#scan" data-toggle="tab" aria-expanded="false" onclick="javascript:ajaxloadscandetails();">
                                                        <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                                        <span class="hidden-xs">Scan</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="#dental" data-toggle="tab" aria-expanded="false" onclick="javascript:ajaxloaddentaldetails();">
                                                        <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                                        <span class="hidden-xs">Dental</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="#xray" data-toggle="tab" aria-expanded="false" onclick="javascript:ajaxloadxraydetails();">
                                                        <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                                        <span class="hidden-xs">X-Ray</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="blood"  >
                                            <p>
                                            <div class="col-md-12">
                                            </div>
                                            <br/>
                                            <div style="width:100%;" id="patientblooddiv">


                                            </div>

                                            </p>
                                        </div>
                                        <div class="tab-pane active" id="motion"  >
                                            <p>
                                            <div class="col-md-12">
                                            </div>
                                            <br/>
                                            <div style="width:100%;" id="patientmotiondiv"></div>
                                            </p>
                                        </div>
                                         <div class="tab-pane active" id="urine"  >
                                            <p>
                                            <div class="col-md-12">
                                            </div>
                                            <br/>
                                            <div style="width:100%;" id="patienturinediv"></div>
                                            </p>
                                        </div>
                                         <div class="tab-pane active" id="ultra">
                                            <p>
                                            <div class="col-md-12">
                                            </div>
                                            <br/>
                                            <div style="width:100%;" id="patientultradiv"></div>
                                            </p>
                                        </div>
                                         <div class="tab-pane active" id="scan"  >
                                            <p>
                                            <div class="col-md-12">
                                            </div>
                                            <br/>
                                            <div style="width:100%;" id="patientscandiv"></div>
                                            </p>
                                        </div>
                                         <div class="tab-pane active" id="dental"  >
                                            <p>
                                            <div class="col-md-12">
                                            </div>
                                            <br/>
                                            <div style="width:100%;" id="patientdentaldiv"></div>
                                            </p>
                                        </div>
                                         <div class="tab-pane active" id="xray"  >
                                            <p>
                                            <div class="col-md-12">
                                            </div>
                                            <br/>
                                            <div style="width:100%;" id="patientxraydiv"></div>
                                            </p>
                                        </div>


                                    </div>


                                </div>


<!--  <select name="address" id="address" class="form-control" placeholder="Address">
     <option>Select Address</option>
 </select>-->






                        </div>



                    </div>
                </div>



                <!--row end-->
            </div>
        </div>
    </div>
</section>
    @endsection

