<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>         <!-- For-Mobile-Apps-and-Meta-Tags -->
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
        <link rel="stylesheet" href="css1/jquery-ui.css" />
        <script type="text/javascript" src="js1/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="js1/numscroller-1.0.js"></script>
        <!-- font-awesome icons -->
        <link href="css1/font-awesome.css" rel="stylesheet" type="text/css" media="all" />
        <style>   .fa.fa-chevron-circle-right {
                right: 0;
            }
            .fa.fa-chevron-circle-left {
                left: 0;
            }
            .fa.fa-chevron-circle-right, .fa.fa-chevron-circle-left {
                margin-bottom: 1px;
                position: absolute;
                top: 59px;
                color:#1f319f;
                font-size: 50px;
            }
            .col-img-responsive02 span{
                color:#fff;
            }
            .col-img-responsive02 {

                display:none;
                background: none repeat scroll 0 0 rgba(0, 0, 0, 0.6);
                height: 100%;
                position: absolute;
                width: 100%;
            }
            .carousel-control{
                width:5%;
            }
            .panel-body{
                position:relative;
                padding:0px;
            }
            .btn-primary {
                background-color: #337ab7;
                border-color: #2e6da4;
                border-radius: 0;
                bottom: -15px;
                color: #fff;
                position: relative;
                width: 100%;
                -webkit-box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.38);
                -moz-box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.38);
                box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.38);	
            }
            .btn-primary {
                background-color: #1f319f;
                border-color: #fff;
            }
            .panel-default{
                -webkit-box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.38);
                -moz-box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.38);
                box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.38);
                border: medium none;
                border-radius: 0;
            }

            .panel-heading{
                padding:0px;
                position:relative;
                background:#fff; 
            }
            .panel-heading img{
                width:40%;
            }
            .carousel-control.left {
                background-image: none;
                font-size: 80px;
                color:#1f319f;
                margin-left: -59px;
            }
            .carousel-control.right{
                background-image: none;
                font-size: 80px;
                color:#1f319f;
                margin-right: -59px;
            }


            .bg-panel{
                background-color:#fff;

            }</style>
    </head>
    @yield('styletext','')

    <!-- //font-awesome icons -->

    @if( session('userID') && time()-session('logintime')<300)
    {{ session(['logintime' => time()])}}
    <body class="bg" onload=@yield('loadfunction','')>
        <div class="overlay overlay-simplegenie">
            <button type="button" class="overlay-close"><i class="fa fa-times" aria-hidden="true"></i></button>
            <nav>
                <ul>
                    <li><a href="logout">Logout</a></li>
                    <li><a href="index">Home</a></li>
                    <li><a href="appointment?methode=Doctor">Appointments</a></li>
                    <li><a href="labappointment?methode=Lab">Diagnostics</a></li>
                    <li><a href="secondoption">Second Opinion</a></li>
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
                <h1 st><a href="index"><img src="images/logo.jpg" width="220" height="70" alt=""/></a></h1>

            </div>

            <div class="clearfix"> <font style="color: #060064"> welcome  {{ ucwords(session('userID')) }}</font> </div>

        </section>
        <!-- //menu -->


        <!-- banner -->
        <div class="banner-silder">
            <div class="callbacks_container">
                <ul class="rslides callbacks callbacks1" id="slider4">
                    <li>
                        <div class="w3layouts-banner-top">

                            <div class="container">
                                <div class="agileits-banner-info">
                                    <h3>Qualified Doctors</h3>
                                </div>	
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="w3layouts-banner-top w3layouts-banner-top1">
                            <div class="container">
                                <div class="agileits-banner-info">
                                    <h3>Emergency Services</h3>
                                </div>	
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="w3layouts-banner-top w3layouts-banner-top2">
                            <div class="container">
                                <div class="agileits-banner-info">
                                    <h3>Intensive Care</h3>
                                </div>

                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="w3layouts-banner-top w3layouts-banner-top3">
                            <div class="container">
                                <div class="agileits-banner-info">
                                    <h3>Medical professionals</h3>
                                </div>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!-- //banner -->
        @yield('bodycontent')


        <!--location slider -->
        <div class="clear" style="width:100%;height:50px;"></div>
        <div class="container">
            <header id="myCarousel" class="carousel slide">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php $x = 0; ?>
                        @foreach($hospitals as $hospital)      
                        <?php if ($x == 0) { ?>
                            <div class="item active">
                            <?php } else { ?>
                                <div class="item ">
                                <?php } $x++; ?>



                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="background-color:#fff;">
                                                <div class="col-img-responsive02"></div>
                                                <img src="images/call_us.jpg"/>
                                            </div>
                                            <div class="panel-body">
                                                <h4>Give us a call to {{ $hospital['hospital_name'] }} </h4>
                                                <P>{{ $hospital['hospital_name'] }}</P>
                                                <P>{{ $hospital['telephone'] }}</P>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="background-color:#fff;">
                                                <div class="col-img-responsive02"></div>
                                                <img src="images/send_mes.jpg"/>
                                            </div>
                                            <div class="panel-body">
                                                <h4>Send Mail to {{ $hospital['hospital_name'] }} </h4>
                                                <P>{{ $hospital['hospital_name'] }}</P>
                                                <P>{{ $hospital['email'] }}</P>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading" style="background-color:#fff;">
                                                <div class="col-img-responsive02"></div>
                                                <img src="images/loca_i.jpg"/>
                                            </div>
                                            <div class="panel-body">
                                                <h4>Location {{ $hospital['hospital_name'] }} </h4>
                                                <P>{{ $hospital['hospital_name'] }}</P>
                                                <p>{{ $hospital['address'] }}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            @endforeach
                        </div>


                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span  aria-hidden="true"><i class="fa fa-4px fa-angle-left"></i>
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span  aria-hidden="true"><i class="fa fa-angle-right"></i>
                            </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
            </header>

        </div>	
        <br>
        <!-- footer -->
        <div class="footer">


            <div class="agileinfo_footer_bottom1">
                <div class="container">
                    <p>© 2017 Clinical Care. All rights reserved | Design by <a href="http://glovision..com">Glovision</a></p>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <!-- //footer -->

        <!-- js -->

        <!-- //js -->
        <script src="js1/jquery.nicescroll.js"></script>        <script src="js1/scripts.js"></script>

        <!--responsiveslides js-->
        <script src="js1/responsiveslides.min.js"></script>
        <script>
// You can also use "$(window).load(function() {"
$(function () {
    // Slideshow 4
    $("#slider4").responsiveSlides({
        auto: true,
        pager: true,
        nav: false,
        speed: 500,
        namespace: "callbacks",
        before: function () {
            $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
            $('.events').append("<li>after event fired.</li>");
        }
    });

});
        </script>
        <script>
            // You can also use "$(window).load(function() {"
            $(function () {
                // Slideshow 3
                $("#slider3").responsiveSlides({
                    auto: true,
                    pager: false,
                    nav: true,
                    speed: 500,
                    namespace: "callbacks",
                    before: function () {
                        $('.events').append("<li>before event fired.</li>");
                    },
                    after: function () {
                        $('.events').append("<li>after event fired.</li>");
                    }
                });

            });
        </script>

        <!--//responsiveslides js-->
        <script src="js1/SmoothScroll.min.js"></script>
        <!--menu script-->
        <script type="text/javascript" src="js1/modernizr-2.6.2.min.js"></script>
        <script src="js1/classie.js"></script>
        <script src="js1/demo1.js"></script>
        <!--//menu script-->
              <link rel="stylesheet" type="text/css" href="css1/jquery.datetimepicker.css"/>
<script src="js1/jquery.datetimepicker.js" type="text/javascript"></script>
        <!-- //Calendar -->
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