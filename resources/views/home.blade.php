@extends('layouts.app')
@section('title','Daiwik Welcome')
@section('styletext')
<style>
        .main_title {
            font-family: Calibri;
            font-size: 44px;
            padding-bottom: 30px;
            margin-top: 30px;
            text-align: center;
            line-height: 65px;
            text-transform: uppercase;
            color: #2b2b2b;
        }
        .main_title span {
            border-bottom: 1px solid #666;
        }

        .box {
            border-radius: 3px;
            /*box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);*/
            padding: 21px 30px;
            text-align: right;
            display: block;
            /* margin-top: 60px; */cursor: pointer;
        }
        .box-icon span {
            color: #fff;
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }
        .info h4 {
            color: #555454;
            font-size: 12px;
            margin: 0px;
            font-family: Calibri;
            font-weight: 100;
            padding: 21px 0px;
            text-transform: uppercase;
        }
        .info > p {
            color: #717171;
            font-size: 16px;
            text-align: center;
        }

        .box >.box-icon {
            border: 2px solid #999;
        }
        .box:hover >.box-icon {
            border: 2px solid #999;
            background-color: #fff;
            color: #82b440;
            -webkit-transition: All 0.5s ease;
            -moz-transition: All 0.5s ease;
            -o-transition: All 0.5s ease;
        }
        .box:hover >.box-icon >span {
            color: #82b440;
        }
       .box-icon {
	background: #446e92; /* Old browsers */

	border-radius: 50%;
	display: table;
	height: 120px;
	margin: 0 auto;
	width: 120px;/*margin-top: -61px;*/
	
-moz-box-shadow: 10px 10px 5px #ccc; -webkit-box-shadow: 10px 10px 5px #ccc; box-shadow: 10px 10px 5px #ccc; -moz-border-radius:0px; -webkit-border-radius:50%; border-radius:50%;
  box-shadow: 0 20px 20px #ccc;
 
	
}


<!--color1-->
.box-icon1 {
	background: #f20 ;

	border-radius: 50%;
	display: table;
	height: 120px;
	margin: 0 auto;
	width: 120px;/*margin-top: -61px;*/
}
.bg-color1{
	
background:#00bcd4 ; /* Old browsers */
 

	
	}
	
	.bg-color2{
	background: #18831b; /* Old browsers */
	}

.bg-color3{
	background: #e2139a; /* Old browsers */

	}
	
	
.bg-color4{
	background: #009a8c; /* Old browsers */

	}
	
	
	.bg-color5{
	background: #ff8b14; /* Old browsers */

	}
	
	.bg-color6{
background: #fb79c4; /* Old browsers */

	}
	
	
	.bg-color7{
background: #055194; /* Old browsers */

	}
        .fa.fa-chevron-circle-right {
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
	
	}
    </style>
 @endsection  
@section('bodycontent')
 <!--services start-->
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-12">
                   <p class="main_title"><span>services</span></p>
                 </div>-->
            </div>
            <div class="row">
                <a href="appointment?methode=Doctor" class="opt-grids">
                    <div class="col-md-3 col-sm-3 col-xs-12 " >
                        <div class="box">
                            <div class="box-icon"> <span class="fa fa-4x fa-calendar"></span> </div>
                            <div class="info">
                                <h4 class="text-center">Appointments</h4>

                            </div>
                        </div>
                    </div>
                </a>
                <a href="labappointment?methode=Lab" class="opt-grids">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="box">
                            <div class="box-icon bg-color1"> <span class="fa fa-4x fa-stethoscope"></span> </div>
                            <div class="info">
                                <h4 class="text-center">Diagnostics</h4>

                            </div>
                        </div>
                    </div>
                </a>
                <a href="pharmaciesappointment?methode=Pharmacy" class="opt-grids">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="box">
                            <div class="box-icon bg-color2"> <span class="fa fa-4x fa-medkit"></span> </div>
                            <div class="info">
                                <h4 class="text-center">Pharmacy Pickup </h4>

                            </div>
                        </div>
                    </div>
                </a>
                <a href="secondopinion" class="opt-grids">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="box">
                            <div class="box-icon bg-color3"> <span class="fa fa-4x fa-book"></span> </div>
                            <div class="info">
                                <h4 class="text-center">Second Opinion</h4>

                            </div>
                        </div>
                    </div>
                </a>
                <a href="doctors" class="opt-grids">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="box">
                            <div class="box-icon bg-color4"> <span class="fa fa-4x fa-phone"></span> </div>
                            <div class="info">
                                <h4 class="text-center">QQQConnect to Doctor</h4>

                            </div>
                        </div>
                    </div>
                </a>

               <!-- <a href="clinicshospitalsdoctors" class="opt-grids">-->
               <!--     <a href="#" class="opt-grids">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="box">
                            <div class="box-icon"> <span class="fa fa-4x fa-hospital-o"></span> </div>
                            <div class="info">
                                <h4 class="text-center">Clinics /hospital/Doctors</h4>

                            </div>
                        </div>
                    </div>
                </a>-->
                <a href="articles" class="opt-grids">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="box">
                            <div class="box-icon bg-color5"> <span class="fa fa-4x fa-envelope"></span> </div>
                            <div class="info">
                                <h4 class="text-center">Feeds</h4>

                            </div>
                        </div>
                    </div>
                </a>
                <a href="askquest" class="opt-grids">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="box">
                            <div class="box-icon bg-color6"> <span class="fa fa-4x fa-question"></span> </div>
                            <div class="info">
                                <h4 class="text-center">Ask a question</h4>

                            </div>
                        </div>
                    </div>
                </a>

                <a href="history" class="opt-grids">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="box">
                            <div class="box-icon bg-color7"> <span class="fa fa-4x fa-book"></span> </div>
                            <div class="info">
                                <h4 class="text-center">Patient Records</h4>

                            </div>
                        </div>
                    </div>
                </a>





            </div>
        </div>
@endsection
