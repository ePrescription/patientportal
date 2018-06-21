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
                height: 80px;
                margin: 0 auto;
                width: 80px;/*margin-top: -61px;*/

                -moz-box-shadow: 10px 10px 5px #ccc; -webkit-box-shadow: 10px 10px 5px #ccc; box-shadow: 10px 10px 5px #ccc; -moz-border-radius:0px; -webkit-border-radius:50%; border-radius:50%;
                box-shadow: 13px -1px 8px #b4cec9;


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
        </style>
@endsection  
@section('bodycontent')
<br>
        <!-- services -->
        <div class="services-w3-agileits">
            <div class="container">
               

                <div class="row">
                    <a href="http://www.nejm.org/medical-research/cardiology-general" class="opt-grids" target="_blank">
                        <div class="col-md-3 col-sm-3 col-xs-12 " >
                            <div class="box">
                                <div class="box-icon bg-color1" style='font-size: 29px'> <span class="fa fa-heart"></span> </div>
                                <div class="info">
                                    <h4 class="text-center"><b>Cardiology</b></h4>

                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="http://www.dentistryiq.com/articles/2013/06/the-most-common-lies-dentists-tell-themselves.html" target="_blank">
                        <div class="col-md-3 col-sm-3 col-xs-12 " >
                            <div class="box">
                                <div class="box-icon bg-color1" style='font-size: 29px'> <span class="fa fa-medkit" aria-hidden="true"></span> </div>
                                <div class="info">
                                    <h4 class="text-center"><b>Dental care</b></h4>

                                </div>
                            </div>
                        </div>
                    </a> 
                    <a href="https://www.mdlinx.com/neurology/journal-summaries/" target="_blank">
                        <div class="col-md-3 col-sm-3 col-xs-12 " >
                            <div class="box">
                                <div class="box-icon bg-color1" style='font-size: 29px'> <span class="fa fa-wheelchair" aria-hidden="true"></span> </div>
                                <div class="info">
                                    <h4 class="text-center"><b>Neurology</b></h4>

                                </div>
                            </div>
                        </div>
                    </a>  
                    <a href="https://markmanson.net/four-stages-of-life" target="_blank">                    <div class="col-md-3 col-sm-3 col-xs-12 " >
                            <div class="box">
                                <div class="box-icon bg-color1" style='font-size: 29px'> <span class="fa fa-user" aria-hidden="true"></span> </div>
                                <div class="info">
                                    <h4 class="text-center"><b>ENT treatment</b></h4>

                                </div>
                            </div>
                        </div>
                    </a> 
                    </a>  
                    <a href="http://www.ima-india.org/ima/" target="_blank">                 <div class="col-md-3 col-sm-3 col-xs-12 " >
                            <div class="box">
                                <div class="box-icon bg-color1" style='font-size: 29px'> <span class="fa fa-user-md" aria-hidden="true"></span> </div>
                                <div class="info">
                                    <h4 class="text-center"><b>Indian Medical Association</b></h4>

                                </div>
                            </div>
                        </div>
                    </a>  
                    <a href="https://www.ama-assn.org/" target="_blank">  
                        <div class="col-md-3 col-sm-3 col-xs-12 " >
                            <div class="box">
                                <div class="box-icon bg-color1" style='font-size: 29px'> <span class="fa fa-ambulance" aria-hidden="true"></span> </div>
                                <div class="info">
                                    <h4 class="text-center"><b>American Medical Association</b></h4>

                                </div>
                            </div>
                        </div>
                    </a>  
                   <a href="https://www.bma.org.uk/" target="_blank"> 
                        <div class="col-md-3 col-sm-3 col-xs-12 " >
                            <div class="box">
                                <div class="box-icon bg-color1" style='font-size: 29px'> <span class="fa fa-ambulance" aria-hidden="true"></span> </div>
                                <div class="info">
                                    <h4 class="text-center"><b>British Medical Association</b></h4>

                                </div>
                            </div>
                        </div>
                    </a>  
                    


                </div>





               
              
                <div class="clearfix"> </div>
            </div>
        </div>
        <!-- //services --> 
@endsection
