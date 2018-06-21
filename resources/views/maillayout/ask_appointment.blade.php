<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>letter</title> 
        <!-- For-Mobile-Apps-and-Meta-Tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Clinical Care Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, SmartPhone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- //For-Mobile-Apps-and-Meta-Tags -->
        <!-- Custom Theme files -->
        <link href="css1/bootstrap.css" type="text/css" rel="stylesheet" media="all">
        <link rel="stylesheet" type="text/css" href="css1/style11.css" /><!-- menu style sheet -->
        <link href="css1/style.css" type="text/css" rel="stylesheet" media="all"> 
        <!-- //Custom Theme files -->
        <!-- font-awesome icons -->
        <link href="css1/font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
        <!-- //font-awesome icons -->

        <!-- web-fonts -->  

        <!-- //web-fonts -->

        <style>
            .text-danger strong {
                color: #9f181c;
            }
            .receipt-main {
                background: #ffffff none repeat scroll 0 0;
                border-bottom: 12px solid #3f51b5;
                border-top: 12px solid #3f51b5;
                margin-top: 50px;
                margin-bottom: 50px;
                padding: 40px 30px !important;
                position: relative;
                box-shadow: 0 1px 21px #acacac;
                color: #333333;
                font-family: open sans;
            }
            .receipt-main p {
                color: #333333;
                font-family: open sans;
                line-height: 1.42857;
            }
            .receipt-footer h1 {
                font-size: 15px;
                font-weight: 400 !important;
                margin: 0 !important;
            }
            .receipt-main::after {
                background: #414143 none repeat scroll 0 0;
                content: "";
                height: 5px;
                left: 0;
                position: absolute;
                right: 0;
                top: -13px;
            }
            .receipt-main thead {
                background: #414143 none repeat scroll 0 0;
            }
            .receipt-main thead th {
                color:#fff;
            }
            .receipt-right h5 {
                font-size: 15px;
                font-weight: bold;
                margin: 0 0 7px 0;
            }
            .receipt-right p {
                font-size: 12px;
                margin: 0px;
            }
            .receipt-right p i {
                text-align: center;
                width: 18px;
            }
            .receipt-main td {
                padding: 4px 20px !important;
            }
            .receipt-main th {
                padding: 13px 20px !important;
            }
            .receipt-main td {
                font-weight:bold;
                font-size: 13px;
                font-weight: initial !important;
            }
            .receipt-main td p:last-child {
                margin: 0;
                padding: 0;
            }	
            .receipt-main td h2 {
                font-size: 20px;
                font-weight: 900;
                margin: 0;
                text-transform: uppercase;
            }
            .receipt-header-mid .receipt-left h1 {
                font-weight: 100;
                margin: 34px 0 0;
                text-align: right;
                text-transform: uppercase;
            }
            .receipt-header-mid {
                margin: 24px 0;
                overflow: hidden;
            }

            #container {
                background-color: #dcdcdc;
            }
        </style>

    </head>
    @if( session('userID') && time()-session('logintime')<300)
    {{ session(['logintime' => time()])}}
    <body class="bg">




        <!--letter start-->

        <div >
            <div class="row">

                <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                    <div class="row">
                        <div class="receipt-header">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="receipt-left">
                                    <img src="images/logo.jpg" width="220" height="70" alt=""/>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                <div class="receipt-right">
                                    <h5>{{$doctorappointments[0]->hospital_name}}.</h5>
                                    <p>{{$doctorappointments[0]->telephone}} <i class="fa fa-phone"></i></p>
                                    <p>{{$doctorappointments[0]->email}} <i class="fa fa-envelope-o"></i></p>
                                    <p>{{$doctorappointments[0]->hsaddress}} <i class="fa fa-location-arrow"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h1 style="font-size:20px; font-weight:bold;">Dear Sir/Madam,</h1>
                    </div>
                    <div class="row">
                        <div class="receipt-header receipt-header-mid">
                            <div >
                                <div class="receipt-right">

                                    <table border="1">

                                        <tbody>
                                             <tr>
                                                <td class="col-md-9">Patient ID:</td>
                                                <td class="col-md-3">{{session('patient_id')}}</td>
                                            </tr>
                                             <tr>
                                                <td class="col-md-9">Patient Name:</td>
                                                <td class="col-md-3">{{session('userID')}}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-9">Doctor Name:</td>
                                                <td class="col-md-3">{{ $doctorappointments[0]->name}}({{ $doctorappointments[0]->specialty}})</td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-9">Disease details:</td>
                                                <td class="col-md-3">{{ $doctorappointments[0]->brief_history}}</td>

                                            </tr>
                                            
                                            <tr>
                                                <td class="col-md-9">Doctor Review Summary / Points:</td>
                                                <td class="col-md-3"></td>

                                            </tr>
                                            <tr>
                                                <td class="col-md-9">Doctor Treatment Recommendations:</td>
                                                <td class="col-md-3">{{ $doctorappointments[0]->answer}}</td>

                                            </tr>
                                           
                                            <tr>
                                                <td class="col-md-9">Date of Request :</td>
                                                <td class="col-md-3">{{ $doctorappointments[0]->appointment_date}}</td>
                                            </tr>
                                           
                                            <tr>
                                                <td class="col-md-9"> Date of Response :</td>
                                                <td class="col-md-3">{{ $doctorappointments[0]->response_date}}</td>

                                            </tr>
                                             <tr>
                                                <td class="col-md-9">From: Hospital / Nursing Home / Clinic :</td>
                                                <td class="col-md-3">{{ $doctorappointments[0]->hospital_name}}</td>
                                            </tr>
                                             <tr>
                                                <td class="col-md-9">Subject :</td>
                                                <td class="col-md-3">{{ $doctorappointments[0]->subject}}</td>
                                            </tr>
                                            
                                            
                                            
                                        </tbody>
                                    </table>
                                    Uploaded Documents:<br>
                                   @if( $doctorappointments[0]->reports!="")
                                        <?php $paths=explode("@@",$doctorappointments[0]->reports);
                                         foreach($paths as $path){
                                             if($path!="")
                                           echo "<a href='public/askquestion/$path' target='_blank'><img src='public/askquestion/$path' with='200' height='200px' /><a>";
                                           
                                         }
                                         ?>
                                   @endif
                                   @if( $doctorappointments[0]->prescription!="")
                                        <?php $paths=explode("@@",$doctorappointments[0]->prescription);
                                         foreach($paths as $path){
                                             if($path!="")
                                           echo "<a href='public/storage/askquestion/$path' target='_blank'>
                                              <img src='public/storage/askquestion/$path' with='200' height='200px' />
                                              </a>";
                                           
                                         }
                                         ?>
                                   @endif


                                    <!--
                                                                    <h5>From: Hospital / Nursing Home / Clinic / Doctor Name</h5>
                                        <h5>Patient Name:</h5>
                                        <h5>Doctor Name:</h5>
                                        <h5>Date of Appointment:</h5>
                                        <h5>Time of Appointment:</h5>
                                        <h5>Brief Description of Illness:</h5>
                                         <h5>Link to Location Map:</h5>-->

                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="row">
                        <div class="receipt-header receipt-header-mid receipt-footer">
                            <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                                <div class="receipt-right">
                                    <p><b>With Warm Regards </b> </p>
                                    <h6 style="color: rgb(140, 140, 140);">  DrALLCAPS Team </h6>{{ date('d-m-Y')}}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="receipt-left">
                                    <h1>Signature</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>    
            </div>
        </div>	




        <!--letter end-->







    </body>
    @else
    @include('welcome')

    @endif
</html>