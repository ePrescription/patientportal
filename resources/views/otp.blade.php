<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Daiwik/Read More</title>

  <!-- css -->
  
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <link href="css/panel.css" rel="stylesheet">
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
  

  <!-- boxed bg -->
 <!-- <link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />-->
  <!-- template skin -->
 
 <!--date picker start--> 
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  
  <!--date picker start--> 

  
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">

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
          <a class="navbar-brand" href="welcome">
                    <img src="img/logo.png" alt="" class="img1" width="150" height="50"/>
                </a>
        </div>

       <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
             
          
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
    </nav>
    <br><br><br><br><br><br>
<center>


        <div class='success'>
            <b>  {{ $msg }}</b>

        </div>
      
        <form action="otpconfirm" method="post">
            {{ csrf_field() }}
            <input type="text" name='otp' placeholder="Enter One Time Password">
            <input type="submit" value="Submit">

        </form>
    </center>




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


  

</body>

</html>