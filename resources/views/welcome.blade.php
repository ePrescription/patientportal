<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Daiwik</title>

    <!-- css -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="plugins/cubeportfolio/css/cubeportfolio.min.css">
    <link href="css/nivo-lightbox.css" rel="stylesheet"/>
    <link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css"/>
    <link href="css/owl.carousel.css" rel="stylesheet" media="screen"/>
    <link href="css/owl.theme.css" rel="stylesheet" media="screen"/>
    <link href="css/animate.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/flexslider.css" rel="stylesheet"/>
    <link id="t-colors" href="color/default.css" rel="stylesheet">

    <!--date picker start-->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="css1/jquery.datetimepicker.css"/>

   <style>
       .error{
           color: #ff200b;
       }
   </style>

    <!--date picker start-->


</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">


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
                <a class="navbar-brand" href="/">
                    <img src="img/logo.png" alt="" class="img1" width="150" height="50"/>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#" data-toggle="modal" data-target="#login-modal"><span
                                    class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#signup-modal"><span
                                    class="glyphicon glyphicon-user"></span>Register</a></li>


                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Section: intro -->

    <!--sliders start-->


    <!-- start header -->

    <section id="banner" style="margin-bottom:20px;">

        <!-- Slider -->
        <div id="main-slider" class="flexslider">
            <ul class="slides">
                <li>
                    <img src="img/ban1.jpg" alt=""/>
                    <div class="flex-caption">
                        <h3 style="color:blue; font-style: italic">Appointments</h3>
                        <!--<p>You can trust us</p> -->

                    </div>
                </li>
                <li>
                    <img src="img/ban2.jpg" alt=""/>
                    <div class="flex-caption">
                        <h3 style="color:blue; font-style: italic">Diagnostics</h3>
                        <!--<p>You can trust us</p> -->

                    </div>
                </li>

                <li>
                    <img src="img/ban3.jpg" alt=""/>
                    <div class="flex-caption">
                        <h3 style="color:blue; font-style: italic">Pharmacy Pickup</h3>
                        <!--<p>You can trust us</p> -->

                    </div>
                </li>

                <li>
                    <img src="img/ban4.jpg" alt=""/>
                    <div class="flex-caption">
                        <h3 style="color:blue; font-style: italic">Second Opinion</h3>
                        <!--<p>You can trust us</p> -->

                    </div>
                </li>

                <li>
                    <img src="img/ban5.jpg" alt=""/>
                    <div class="flex-caption">
                        <h3 style="color:blue; font-style: italic">Connect to Doctor</h3>
                        <!--<p>You can trust us</p> -->

                    </div>
                </li>

                <li>
                    <img src="img/ban6.jpg" alt=""/>
                    <div class="flex-caption">
                        <h3 style="color:blue; font-style: italic">Feeds</h3>
                        <!--<p>You can trust us</p> -->

                    </div>
                </li>

                <li>
                    <img src="img/ban7.jpg" alt=""/>
                    <div class="flex-caption">
                        <h3 style="color:blue; font-style: italic">Ask a question</h3>
                        <!--<p>You can trust us</p> -->

                    </div>
                </li>

                <li>
                    <img src="img/ban8.jpg" alt=""/>
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


    <!--login model start-->

    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="log-section">
                <h1>Login to Your Account</h1><br>
                <form action="{{URL::to('/')}}\login" method="post">
                    {{ csrf_field() }}
                    <input type="text" class="email" name="Email" placeholder="Email" required/>
                    <input type="password" class="password" name="Password" placeholder="Password" required/>
                    <input type="submit" name="login" class="btn btn-skin btn-block btn-lg" value="Login">
                </form>

                <div class="login-help">
                    <a href="#">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>


    <!-- /Section: intro -->


    <div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="log-section">
                <h1>Register for new Account</h1><br>

                <form action="{{URL::to('/')}}\register" method="post" id="registration" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="text" name="name" id="name" placeholder="Username" required=""/>
                    <input type="text" name="email" id="email" placeholder="Email" required=""/>
                    <input type="password" name="password" password="password" placeholder="Password" required=""/>
                    <input type="file" class="form-controlx" name="patient_photo" placeholder="patient_photo"/>
                    <input type="text" name="telephone" id="telephone" placeholder="MobileNumber" required=""/>
                    <input name="dob" id="dob"  class="form-control" type="text" value="" style="line-height: 20px;" required="">
                    <input type="radio" class="form-controlx" id="gender1" name="gender" value="1" required="required"/>&nbsp;&nbsp;Male
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" class="form-controlx" id="gender2" name="gender" value="2" required="required"/>&nbsp;&nbsp;Female

                    <input type="text" name="age" name="age" placeholder="Age" required=""/>
                    <textarea name="address" id="address" required style="width: 301px; height: 89px;"></textarea>
                    <select id="nationality" name="nationality">
                        <option value="">Select Nationality</option>
                        <option value="1">India</option>
                        <option value="2">America</option>
                        <option value="3">Australia</option>
                    </select>
                    <select id="city" name="city">
                        <option value="">Select City</option>
                        <option value="1">Andra Pradesh</option>
                        <option value="2">Telangana</option>
                        <option value="3">Karnataka</option>
                        <option value="4">Chennai</option>

                    </select>
                    <br>

                    <input type="radio" class="form-controlx" id="married" name="married" value="1"
                           required="required"/>&nbsp;&nbsp;Married
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" class="form-controlx" id="married" name="married" value="2"
                           required="required"/>Un Married

                    <select id="hospitalId" name="hospitalId">
                        @foreach($hospitals as $hospital)
                            <option value="{{ $hospital['hospital_id'] }}">

                                {{ $hospital['hospital_name'] }}
                            </option>
                        @endforeach
                    </select>
                    <div class="wthree-text">

                        <input type="checkbox" class="checkbox">
                        <span> I accept the terms of use</span>

                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="box-footer">
                        <input type="hidden" class="form-control" name="prev_appointment_date"
                               id="prev_appointment_date" value=""/>
                        <button type="submit" class="btn btn-success" style="float:right;">Register</button>
                    </div>

                </form>


                <div class="login-help">

                </div>
            </div>
        </div>
    </div>
</div>


<!--login model  end-->


<center><h4 style="color:red">{{''}}</h4></center>
<!-- Section: testimonial -->
<section id="testimonial" class="home-section paddingbot-60 parallax" data-stellar-background-ratio="0.5"
         style="margin-bottom:47px;">

    <div class="carousel-reviews broun-block">
        <div class="container">
            <div class="row">
                <div id="carousel-reviews" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">

                        <?php $x = 0; ?>
                        @foreach($hospitals as $hospital)
                            <?php if($x == 0) {?>
                            <div class="item active">
                                <?php }else{ ?>
                                <div class="item ">
                                    <?php } $x++;?>


                                    <div class="col-md-4 col-sm-6">
                                        <div class="block-text rel zmin">
                                            <a title="" href="#">Call Us</a>

                                            <p>Give us a call to {{ $hospital['hospital_name'] }} </p>
                                            <P>{{ $hospital['hospital_name'] }}</P>
                                            <P>{{ $hospital['telephone'] }}</P>
                                            <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                        </div>
                                        <div class="person-text rel text-light">
                                            <img src="img/testimonials/1.jpg" alt="" class="person img-circle"/>

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
                                            <img src="img/testimonials/2.jpg" alt="" class="person img-circle"/>

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
                                            <img src="img/testimonials/3.jpg" alt="" class="person img-circle"/>

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
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/jquery.scrollTo.js"></script>
<script src="js/jquery.appear.js"></script>
<script src="js/stellar.js"></script>
<script src="plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/custom1.js"></script>

<!-- Placed at the end of the document so the pages load faster -->
<!--<script src="js/jquery.js"></script>-->

<script src="js/jquery.flexslider.js"></script>

<!-- Vendor Scripts -->
<script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script>
    $('#dob').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "mm/dd/yy",
        yearRange: "-90:+00"
    });
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
                hospitalId: "required",
                role: "required",
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
                    required: true,
                    number: true,
                    minlength: 1,
                    maxlength: 3
                }

            },
            // Specify validation error messages
            messages: {
                role: "Please choose role",
                hospitalId: "Please choose Hospital",
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


</body>

</html>
