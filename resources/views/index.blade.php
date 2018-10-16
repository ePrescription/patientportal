@extends('layouts.app')
@section('title','Daiwik Welcome')
@section('styletext')

  
 @endsection  
@section('bodycontent')

<!--sliders end-->
 <!--services strat-->
  <!-- Section: boxes -->
    <section id="boxes" class="home-section paddingtop-80">

      <div class="container">
        <div class="row">
             <a href="appointment?methode=Doctor" class="opt-grids">
          <div class="col-sm-3 col-md-3">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <div class="box text-center">

                <i class="fa fa-calendar fa-3x circled bg-skin"></i>
                <h4 class="h-bold">Appointments</h4>
                
              </div>
            </div>
          </div>
             </a> 
            <a href="labappointment?methode=Lab" class="opt-grids">
          <div class="col-sm-3 col-md-3">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <div class="box text-center">

                <i class="fa fa-flask fa-3x circled bg-skin1"></i>
                <h4 class="h-bold">Diagnostics</h4>
               
              </div>
            </div>
          </div>
            </a>
            <a href="pharmaciesappointment?methode=Pharmacy" class="opt-grids">
          <div class="col-sm-3 col-md-3">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <div class="box text-center">
                <i class="fa fa-medkit fa-3x circled bg-skin2"></i>
                <h4 class="h-bold">Pharmacy Pickup</h4>
                
              </div>
            </div>
          </div>
            </a>
            <a href="secondopinion" class="opt-grids">
          <div class="col-sm-3 col-md-3">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <div class="box text-center">

                <i class="fa fa-book fa-3x circled bg-skin3"></i>
                <h4 class="h-bold">Second Opinion</h4>
                
              </div>
            </div>
          </div>
            </a>
             <a href="doctors" class="opt-grids">
          <div class="col-sm-3 col-md-3">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <div class="box text-center">

                <i class="fa fa-user-md fa-3x circled bg-skin4"></i>
                <h4 class="h-bold">Connect to Doctor</h4>
                
              </div>
            </div>
          </div>
             </a>
            <a href="articles" class="opt-grids">
          <div class="col-sm-3 col-md-3">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <div class="box text-center">

                <i class="fa fa-envelope fa-3x circled bg-skin5"></i>
                <h4 class="h-bold">Health Bulletin</h4>
                
              </div>
            </div>
          </div>
            </a>
          <a href="askquest" class="opt-grids">
          <div class="col-sm-3 col-md-3">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <div class="box text-center">

                <i class="fa fa-question fa-3x circled bg-skin6"></i>
                <h4 class="h-bold">Ask a question</h4>
                
              </div>
            </div>
          </div>
          </a>
            <a href="history" class="opt-grids">
          <div class="col-sm-3 col-md-3">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <div class="box text-center">

                <i class="fa fa fa-wheelchair fa-3x circled bg-skin7"></i>
                <h4 class="h-bold">Patient Records</h4>
                
              </div>
            </div>
          </div>
            </a>
            
          
        </div>
      </div>

    </section>
    <!-- /Section: boxes



 
@endsection
