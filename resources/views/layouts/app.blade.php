<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('title')</title>   

        <!-- css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="plugins/cubeportfolio/css/cubeportfolio.min.css">
        <link href="css/nivo-lightbox.css" rel="stylesheet" />
        <link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
        <link href="css/owl.carousel.css" rel="stylesheet" media="screen" />
        <link href="css/owl.theme.css" rel="stylesheet" media="screen" />
        <link href="css/animate.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/flexslider.css" rel="stylesheet" /> 
        <link id="t-colors" href="color/default.css" rel="stylesheet">
        <!--date picker start--> 

        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <!--//menu script-->
        <link rel="stylesheet" type="text/css" href="css1/jquery.datetimepicker.css"/>
        <script src="js1/jquery.datetimepicker.js" type="text/javascript"></script>
        <!--date picker start--> 
        <!-- boxed bg -->
        <!-- <link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />-->
        <!-- template skin -->
        <link id="t-colors" href="color/default.css" rel="stylesheet">

        @yield('styletext','')
    </head>

    @if( session('userID') && time()-session('logintime')<300)
    {{ session(['logintime' => time()])}}
    <body id="page-top" data-spy="scroll" data-target=".navbar-custom" onload=@yield('loadfunction', '')>


        <div id="wrapper">

            <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
                <!-- <div class="top-area">
                   <div class="container">
                     <div class="row">
                       <div class="col-sm-6 col-md-6">
                         <p class="bold text-left">Monday - Saturday, 8am to 10pm </p>
                       </div>
                       <div class="col-sm-6 col-md-6">
                         <p class="bold text-right">Call us now +62 008 65 001</p>
                       </div>
                     </div>
                   </div>
                 </div>-->
                <div class="container navigation">

                    <div class="navbar-header page-scroll">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="index">
                            <img src="img/logo.png" alt="" class="img1" width="150" height="50" />
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                        <ul class="nav navbar-nav">



                            <li><a href="index">Home</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" <span class="badge custom-badge red pull-right">Appointments</span> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="appointment?methode=Doctor">Doctor Appointments</a></li>
                                    <li><a href="labappointment?methode=Lab">Diagnostics Appointments</a></li>
                                    <li><a href="pharmaciesappointment?methode=Pharmacy">Pharmacy Pickup</a></li>

                                </ul>
                            </li>




                            <li><a href="secondoption">Second Opinion</a></li>
                            <li><a href="doctors">Connect to Doctor</a></li>

                            <!-- <li><a href="#">Clinics/Hospitals/Doctors</a></li>                 -->
                            <li><a href="articles">Feeds</a></li>
                            <li><a href="askquest">Ask a Question</a></li>
                            <li><a href="history">Patient Records</a></li>
                            <li><a href="logout">Logout</a></li>

                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav><br><br>


           <!-- Section: intro -->

            <!--sliders start-->


            <!-- start header -->

            <section id="banner" style="margin-bottom:20px;" >

                <!-- Slider -->
                <div id="main-slider" class="flexslider">
                    <ul class="slides">
                        <li>
                            <img src="img/subban1.jpg" alt="" />
                            <div class="flex-caption">
                                <h3 style="color:blue; font-style: italic">Appointments</h3>
                                <!--<p>You can trust us</p> -->

                            </div>
                        </li>
                        <li>
                            <img src="img/subban2.jpg" alt="" />
                            <div class="flex-caption">
                                <h3 style="color:blue; font-style: italic">Diagnostics</h3>
                                <!--<p>You can trust us</p> -->

                            </div>
                        </li>

                        <li>
                            <img src="img/subban3.jpg" alt="" />
                            <div class="flex-caption">
                                <h3 style="color:blue; font-style: italic">Pharmacy Pickup</h3>
                                <!--<p>You can trust us</p> -->

                            </div>
                        </li>

                        <li>
                            <img src="img/subban4.jpg" alt="" />
                            <div class="flex-caption">
                                <h3 style="color:blue; font-style: italic">Second Opinion</h3>
                                <!--<p>You can trust us</p> -->

                            </div>
                        </li>

                        <li>
                            <img src="img/subban5.jpg" alt="" />
                            <div class="flex-caption">
                                <h3 style="color:blue; font-style: italic">Connect to Doctor</h3>
                                <!--<p>You can trust us</p> -->

                            </div>
                        </li>

                        <li>
                            <img src="img/subban6.jpg" alt="" />
                            <div class="flex-caption">
                                <h3 style="color:blue; font-style: italic">Feeds</h3>
                                <!--<p>You can trust us</p> -->

                            </div>
                        </li>

                        <li>
                            <img src="img/subban7.jpg" alt="" />
                            <div class="flex-caption">
                                <h3 style="color:blue; font-style: italic">Ask a question</h3>
                                <!--<p>You can trust us</p> -->

                            </div>
                        </li>

                        <li>
                            <img src="img/subban8.jpg" alt="" />
                            <div class="flex-caption">
                                <h3 style="color:blue; font-style: italic">Patient Records</h3>
                                <!--<p>You can trust us</p> -->

                            </div>
                        </li>

                    </ul>
                </div>
                <!-- end slider -->
            </section>



            <!--sliders end-->



            @yield('bodycontent')

                 


            <!--services end-->






            <!-- Section: testimonial -->
            <section id="testimonial" class="home-section paddingbot-60 parallax" data-stellar-background-ratio="0.5" style="margin-bottom:45px;">

                <div class="carousel-reviews broun-block">
                    <div class="container">
                        <div class="row">
                            <div id="carousel-reviews" class="carousel slide" data-ride="carousel">

                                <div class="carousel-inner">

                                    <?php $x = 0; ?>
                                    @foreach($hospitals as $hospital)      
                                    <?php if ($x == 0) { ?>
                                        <div class="item active">
                                        <?php } else { ?>
                                            <div class="item ">
                                            <?php } $x++; ?>


                                            <div class="col-md-4 col-sm-6">
                                                <div class="block-text rel zmin">
                                                    <a title="" href="#">Call Us</a>

                                                    <p>Give us a call to {{ $hospital['hospital_name'] }} </p>
                                                    <P>{{ $hospital['hospital_name'] }}</P>
                                                    <P>{{ $hospital['telephone'] }}</P>
                                                    <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                                </div>
                                                <div class="person-text rel text-light">
                                                    <img src="img/testimonials/1.jpg"  alt="" class="person img-circle" />

                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 hidden-xs">
                                                <div class="block-text rel zmin">
                                                    <a title="" href="#">Send us a Message</a>

                                                    <p>Send Mail to {{ $hospital['hospital_name'] }} </p>
                                                    <P>{{ $hospital['hospital_name'] }}</P>
                                                    <P>{{ $hospital['email'] }}</P>

                                                    <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                                </div>
                                                <div class="person-text rel text-light">
                                                    <img src="img/testimonials/2.jpg" alt="" class="person img-circle" />

                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
                                                <div class="block-text rel zmin">
                                                    <a title="" href="#">Location</a>

                                                    <p>Location {{ $hospital['hospital_name'] }} </p>
                                                    <P>{{ $hospital['hospital_name'] }}</P>
                                                    <p>{{ $hospital['address'] }}</p>
                                                    <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                                </div>
                                                <div class="person-text rel text-light">
                                                    <img src="img/testimonials/3.jpg" alt="" class="person img-circle" />

                                                </div>
                                            </div>
                                        </div>


                                        @endforeach



                                    </div>

                                    <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <!-- /Section: testimonial -->





            <footer>


                <div class="sub-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="wow fadeInLeft" data-wow-delay="0.1s">
                                    <div class="text-left">
                                        <p>&copy;Copyright2013-2017 All Rights Reserved Design by Glovision.co</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="wow fadeInRight" data-wow-delay="0.1s">
                                    <div class="text-right">
                                        <div class="credits">


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>




        <!-- Core JavaScript Files -->
         <!-- <script src="js/jquery.min.js"></script>-->

<!-- <script src="js/bootstrap.min.js"></script>-->
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.scrollTo.js"></script>
        <script src="js/jquery.appear.js"></script>
        <script src="js/stellar.js"></script>
        <script src="plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/nivo-lightbox.min.js"></script>
        <script src="js/custom.js"></script>




        <!-- Placed at the end of the document so the pages load faster -->
     <!--<script src="js/jquery.js"></script>-->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.flexslider.js"></script>
        <script src="js/custom.js"></script>

        <!-- Vendor Scripts -->


    <script src="js/custom1.js"></script>


    </body>
    @else
    @include('welcome')

    @endif
</html>