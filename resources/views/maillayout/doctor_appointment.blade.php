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
            .bg col-md-offset-2{
                background: #414143 none repeat scroll 0 0;
                content: "";
                height: 5px;
                left: 0;
                position: absolute;
                right: 0;
                top: -13px;
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
<body class="bg col-md-offset-2" style="width: 100%; border: 1px solid #000000; background-color: #ffffff;" >




        <!--letter start-->
        <div class="col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">

            <div class="row">


                <div id="PatientInfoPrint" class="" style="height:100px; border: 1px solid #000000; padding: 5px; line-height: 15px;">
                    <div class="row" style="text-transform: uppercase" >

                        <div class="col-lg-6" style="width:50%;float:left; ">

                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label" style="width:30%;float:left; font-size: 12px; font-weight: bold;">Name</label>
                                <div class="col-sm-9" style="width:70%;float:left; font-size: 11px; font-weight: bold;">
                                    {{$patientExaminations['patientDetails']['name']}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label" style="width:30%;float:left;font-size: 12px; font-weight: bold; ">City/Town</label>
                                <div class="col-sm-9" style="width:70%;float:left; font-size: 11px; font-weight: bold;">
                                    {{$patientExaminations['patientDetails']['address']==""? "----":$patientExaminations['patientDetails']['address'] }}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label" style="width:30%;float:left; font-size: 12px; font-weight: bold;">Ref.DR</label>
                                <div class="col-sm-9" style="width:70%;float:left;font-size: 11px;font-weight: bold; ">
                                    {{count($patientExaminations['doctorDetails'])>0?$patientExaminations['doctorDetails']['name']:"---"}}
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label" style="width:30%;float:left; font-size: 12px; font-weight: bold;">Receipt ID</label>
                                <div class="col-sm-9" style="width:70%;float:left;font-size: 11px;font-weight: bold; ">
                                    {{count($patientExaminations['recieptId'])>0?$patientExaminations['recieptId']:"---"}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label" style="width:30%;float:left; font-size: 12px; font-weight: bold;">Sex</label>
                                <div class="col-sm-9" style="width:70%;float:left; font-size: 11px; font-weight: bold;">
                                    {{ $patientExaminations['patientDetails']['gender']==0 ? "Male" :"Female"}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label" style="width:30%;float:left; font-size: 12px; font-weight: bold;">Age</label>
                                <div class="col-sm-9" style="width:70%;float:left; font-size: 11px; font-weight: bold;">
                                    {{$patientExaminations['patientDetails']['age'] }}
                                </div>
                            </div>



                        </div>

                        <div class="col-lg-6" style="width:50%; float: left;">


                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label" style="width:30%;float:left; font-size: 12px; font-weight: bold;">PID</label>
                                <div class="col-sm-9" style="width:70%;float:left; font-size: 11px; font-weight: bold;">
                                    {{$patientExaminations['patientDetails']['pid']}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label" style="width:30%;float:left; font-size: 12px; font-weight: bold;">E-Mail</label>
                                <div class="col-sm-9" style="width:70%;float:left; font-size: 11px; font-weight: bold;">
                                    {{$patientExaminations['patientDetails']['email']}}
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label" style="width:30%;float:left; font-size: 12px; font-weight: bold;">Sample No</label>
                                <div class="col-sm-9" style="width:70%;float:left; font-size: 11px; font-weight: bold;">
                                    {{"----"}}

                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label" style="width:30%;float:left; font-size: 12px; font-weight: bold;">Specimen</label>
                                <div class="col-sm-9" style="width:70%;float:left; font-size: 11px; font-weight: bold;">
                                    {{"----"}}
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label" style="width:30%;float:left; font-size: 12px; font-weight: bold;">Patient</label>
                                <div class="col-sm-9" style="width:70%;float:left; font-size: 11px; font-weight: bold;">
                                    {{$patientExaminations['patientDetails']['patient_id']}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label" style="width:30%;float:left; font-size: 12px; font-weight: bold;">Test Date</label>
                                <div class="col-sm-9" style="width:70%;float:left; font-size: 11px; font-weight: bold;">
                                </div>
                            </div>
                        </div>

                    </div>

                    <br>
                    <br><br>
                    <br><br>
                    <br><br>
                    <br><br>
                    <br>
                    <div id="ExaminationInfoPrint1"  class="form-group">
                       @if(count($patientExaminations['recentBloodTests'])>0)

                        <!--<div class="form-group" style="background-color: #ffff99; color: black;">
                <label class="col-sm-12 control-label">Blood Test
                   </label>
            </div>-->
                            <div class="form-group" style="font-family:traditional">
                                <div class="col-sm-4" style="width:100%;float:left;">
                                    <table style="width:100%;">
                                        <tr><th style="padding-right: 80px;">Test Name</th><th style="padding-right: 80px;" >Test Report</th><th style="padding-right: 50px;"  >Normal Value</th></tr>
                                        <tr><th colspan="3"><hr/></th></tr>
                                        <?php $parentCheck = "";?>
                                             @foreach($patientExaminations['recentBloodTests'] as $patientExaminations['recentBloodTests'])
                                            @if($patientExaminations['recentBloodTests']['is_parent']==0 && ($parentCheck=="" || $parentCheck!=$patientExaminations['recentBloodTests']['parent_examination_name']))
                                                <?php $parentCheck = $patientExaminations['recentBloodTests']['parent_examination_name']; ?>
                                                <tr style="font-size: 15px; font-weight: bold; align-content: center">
                                                    <td colspan="3"> <b>{{$patientExaminations['recentBloodTests']['parent_examination_name']}}</b> </td>
                                                </tr>

                                            @endif
                                            <tr style="font-size: 13px;font-weight: bold; align-content: center">
                                                <td >
                                                    @if($patientExaminations['recentBloodTests']['is_parent']==0)
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    @endif
                                                    {{$patientExaminations['recentBloodTests']['examination_name']}}
                                                </td>

                                                <td style="padding-left: 50px;"> {{$patientExaminations['recentBloodTests']['test_readings']}}&nbsp;
                                                    {{$patientExaminations['recentBloodTests']['units']}}</td>
                                                <td style="padding-left: 30px;">{{$patientExaminations['recentBloodTests']['default_normal_values']}}</td>

                                            </tr>
                                         @endforeach
                                    </table>
                                </div>

                            </div>
                        @endif

                           @if(count($patientExaminations['recentMotionExaminations'])>0)

                               <div class="form-group" style="color: black;">
                                   <label class="col-sm-12 control-label">Motion Test
                                       - {{$patientExaminations['recentMotionExaminations'][0]['examination_date']}}</label>
                               </div>
                               <div class="form-group ">
                                   <div class="col-sm-4" style="width:100%;float:left;">
                                       <table style="width:100%;float:left;">
                                           @foreach($patientExaminations['recentMotionExaminations'] as $patientExaminations['recentMotionExaminations'])
                                               <tr style="font-size: 13px;font-weight: bold; align-content: center">
                                                   <td>{{$patientExaminations['recentMotionExaminations']['examination_name']}}</td>
                                                   <td>{{$patientExaminations['recentMotionExaminations']['test_readings']}}</td>
                                                   <td>&nbsp;</td>
                                               </tr>


                                           @endforeach
                                       </table>
                                   </div>
                                   -

                               </div>
                           @endif
                           @if(count($patientExaminations['recentUrineExaminations'])>0)

                               <div class="form-group" style="color: black;">
                                   <label class="col-sm-12 control-label">Urine Test
                                       - {{$patientExaminations['recentUrineExaminations'][0]['examination_date']}}</label>
                               </div>
                               <div class="form-group ">
                                   <div class="col-sm-4" style="width:100%;float:left;">
                                       <table style="width:100%;float:left;">

                                           <?php $parentCheck = "";?>
                                           @foreach($patientExaminations['recentUrineExaminations'] as $patientExaminations['recentUrineExaminations'])
                                               @if($patientExaminations['recentUrineExaminations']['is_parent']==0 && ($parentCheck=="" || $parentCheck!=$patientExaminations['recentUrineExaminations']['parent_examination_name']))
                                                   <?php $parentCheck = $patientExaminations['recentUrineExaminations']['parent_examination_name']; ?>
                                                   <tr style=" font-size: 15px;font-weight: bold; align-content: center">
                                                       <td colspan="3"> <b>{{$patientExaminations['recentUrineExaminations']['parent_examination_name']}}</b> </td>
                                                   </tr>

                                               @endif
                                               <tr style="font-size: 13px;font-weight: bold; align-content: center">

                                                   <td style="width:33%;float:left;">
                                                       @if($patientExaminations['recentUrineExaminations']['is_parent']==0)
                                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                       @endif
                                                       {{$patientExaminations['recentUrineExaminations']['examination_name']}}
                                                   </td>

                                                   <td style="width:33%;float:left;"> {{$patientExaminations['recentUrineExaminations']['test_readings']}}</td>
                                                   <td style="width:33%;float:left;">{{$patientExaminations['recentUrineExaminations']['normal_default_values']}}</td>

                                               </tr>




                                           @endforeach
                                       </table>
                                   </div>
                                   -

                    </div>
                           @endif
                       <!--     separate
                {{$patientExaminations['recieptStatus']}}


      letter end-->



           </div>
            </div>
            </div>
        </div>
    </body>



</html>