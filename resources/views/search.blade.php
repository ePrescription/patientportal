<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
    <head>
<title>Daiwik</title>         <!-- For-Mobile-Apps-and-Meta-Tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="keywords" content="Clinical Care Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, SmartPhone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- //For-Mobile-Apps-and-Meta-Tags -->
        <!-- Custom Theme files -->

        <link href="css1/bootstrap.css" type="text/css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="css1/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="css1/style11.css" /><!-- menu style sheet -->
        <link href="css1/style.css" type="text/css" rel="stylesheet" media="all"> 
        <!-- //Custom Theme files -->
        <!-- font-awesome icons -->
        <link href="css1/font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
        <!-- //font-awesome icons -->

        <!-- web-fonts -->  
        <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <!-- //web-fonts -->
    </head>
    @if( session('userID') && time()-session('logintime')<300)
    {{ session(['logintime' => time()])}}
    <body class="bg">
        <div class="overlay overlay-simplegenie">
            <button type="button" class="overlay-close"><i class="fa fa-times" aria-hidden="true"></i></button>
            <nav>
                <ul>
                    <li><a href="logout">Logout</a></li>
                    <li><a href="index">Home</a></li>
                    <li><a href="appointment?methode=Doctor">Appointments</a></li>
                    <li><a href="labappointment?methode=Lab">Diagnostics</a></li>
                    <li><a href="secondopinion">Second Opinion</a></li>
                    <li><a href="doctors">Connect to Doctor</a></li>
                    <li><a href="pharmaciesappointment?methode=Pharmacy">Pharmacies</a></li>
                     <!-- <li><a href="#">Clinics/Hospitals/Doctors</a></li>                 -->
                      <li><a href="articles">Feeds</a></li>
                    <li><a href="askquest">Ask a Question</a></li>
                    <li><a href="history">Patient Records</a></li>
                </ul>
            </nav>
        </div>
         <section class="header-w3ls"> 
            <button id="trigger-overlay" type="button"><i class="fa fa-bars" aria-hidden="true"></i></button> 

            <div >
                <h1 st><a href="index"><img src="{{URL::to('/')}}/images/logo.jpg" width="220" height="70" alt=""/></a></h1>

            </div>

            <div class="clearfix"> <font style="color: #060064"> welcome  {{ ucwords(session('userID')) }}</font> </div>
      
        </section>
        <!-- //menu -->

        <!-- banner -->
        <div class="inner-banner-agileits-w3layouts">
        </div>
        <!-- //banner -->

        <!-- breadcrumbs -->
        <div class="w3l_agileits_breadcrumbs">
            <div class="container">
                <div class="w3l_agileits_breadcrumbs_inner">
                    <ul>
                        <li><a href="/index">Home</a><span>«</span></li>

                        <li>Search For Clinics/Hospitals/Diagnostics</li>
                    </ul>
                </div>
            </div>
        </div>		

        <!-- locations -->
        <div class="locations-w3-agileits">
            <div class="container">
                <div class="location-agileits">
                    <div class="loc-left">
                        <h4>Address 1 :</h4>
                        <p>Hospital Pkwy</p>
                        <p>San Jose, CA USA</p>
                        <p>Telephone : +2 00 544 6035</p>
                        <p>FAX : +1 500 889 5432</p>
                        <p>Email : <a href="mailto:example@email.com">mail@example.com</a></p>
                    </div>
                    <div class="loc-right">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3176.3473567635015!2d-121.80431848469776!3d37.23946527986051!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808e2e2f769431fd%3A0xa9f4531fc4654b6e!2sHospital+Pkwy%2C+San+Jose%2C+CA%2C+USA!5e0!3m2!1sen!2sin!4v1488173775953"></iframe>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="location-agileits">

                    <div class="loc-right">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2645.524697655473!2d-123.43559468427799!3d48.465648479251044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x548f72e6f015c0e1%3A0x9ee24b6bd060938e!2sHospital+Way%2C+Victoria%2C+BC%2C+Canada!5e0!3m2!1sen!2sin!4v1488173899738"></iframe>
                    </div>
                    <div class="loc-left">
                        <h4>Address 2 :</h4>
                        <p>Hospital Way</p>
                        <p>Victoria, BC Canada</p>
                        <p>Telephone : +2 00 544 6035</p>
                        <p>FAX : +1 500 889 5432</p>
                        <p>Email : <a href="mailto:example@email.com">mail@example.com</a></p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="location-agileits">
                    <div class="loc-left">
                        <h4>Address 3 :</h4>
                        <p>University Hospital</p>
                        <p>4056 Basel, Switzerland</p>
                        <p>Telephone : +2 00 544 6035</p>
                        <p>FAX : +1 500 889 5432</p>
                        <p>Email : <a href="mailto:example@email.com">mail@example.com</a></p>
                    </div>
                    <div class="loc-right">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1398467.8906758407!2d7.103157169464006!3d46.79676886804696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4791b9a8781d7953%3A0xbfce93648896fd9f!2sBasel+University+Hospital!5e0!3m2!1sen!2sin!4v1488174074845"></iframe>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <!-- //locations -->
        <!-- footer -->
        <div class="footer">

            <div class="agileinfo_footer_bottom1">
                <div class="container">
                    <p>© 2017 Clinical Care. All rights reserved | Powered by <a href="http://glovision.com">Glovision</a></p>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <!-- //footer -->

        <!-- js -->
        <script type='text/javascript' src='js1/jquery-2.2.3.min.js'></script>
        <!-- //js -->
        <script src="js1/jquery.nicescroll.js"></script>
        <script src="js1/scripts.js"></script>

        <!-- Calendar -->
        <script src="js1/jquery-ui.js"></script>
        <script>
$(function () {
    $("#datepicker,#datepicker1,#datepicker2,#datepicker3").datepicker();
});
        </script>
        <!-- //Calendar -->

        <!--jarallax -->
        <script src="js1/SmoothScroll.min.js"></script>
        <!-- //jarallax -->
        <!--menu script-->
        <script type="text/javascript" src="js1/modernizr-2.6.2.min.js"></script>
        <script src="js1/classie.js"></script>
        <script src="js1/demo1.js"></script>
        <!--//menu script-->
        <!-- banner -->
        <script type='text/javascript' src='js1/jquery.easing.1.3.js'></script> 
        <!-- //banner -->
        <script type="text/javascript">
jQuery(document).ready(function ($) {
    $(".scroll").click(function (event) {
        event.preventDefault();
        $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
    });
});
        </script>
        <!--js for bootstrap working-->
        <script src="js1/bootstrap.js"></script>
        <!-- //for bootstrap working -->
    </body>
    @else
    @include('welcome')

    @endif
</html>
