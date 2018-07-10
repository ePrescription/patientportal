@extends('layouts.app')
@section('title','Daiwik Doctors')
@section('styletext')
<script>
    function loaddoct() {
        //  alert();
        var specialist = $('#specialist').val();
        document.getElementById('doctlist').innerHTML = "";
        $.ajax({
            type: "GET",
            url: 'loaddoctorslist',
            data: {specialty: specialist},
            dataType: 'json',
            success: function (msg) {

                var list = '';
                for (var i = 0; i < msg.length; i++) {
                    var photo = msg[i]['doctor_photo'];
                    //    alert(msg[i]['name']);
                    if (!photo) {
                        photo = 'steth.jpg';
                    }

                    list = list + '<li class="cbp-item psychiatrist" style="position: relative;">'
                            + '<a href="singledoctor?doctorid=' + msg[i]['doctor_id'] + '" class="cbp-caption ">'
                            + ' <div class="cbp-caption-defaultWrap">'
                            + '<img src="{{URL::to('/')}}/public/doctors/' + photo + '" alt="" width="100%" height="100%"></div>'
                            + '<div class="cbp-caption-activeWrap"><div class="cbp-l-caption-alignCenter"><div class="cbp-l-caption-body">'
                            + '<div class="cbp-l-caption-text">VIEW PROFILE</div>'
                            + '</div></div></div></a>'
                            + ' <p>' + msg[i]['name'] + '(' + msg[i]['designation'] + ')</p>'
                            + '<p >' + msg[i]['qualifications'] + '</p></li>';


                    // list = list + '<div class="blog-grid-w3-agileits"><div><img src=storage/doctors/' + photo + ' style="height: 200px; width:200px;"> </div> <div class="blog-info-w3layouts"><h6>' + msg[i]['name'] + '</h6> <div class="inner-info">\n\
//<h3>' + msg[i]['designation'] + '</h3><p class="para-wthree">' + msg[i]['qualifications'] + '.</p></div><a href="singledoctor?doctorid=' + msg[i]['doctor_id'] + '" class="blog-more-agile" >Read More</a></div> <div class="clearfix"></div></div>';
                }
               //list=list;

                $("#doctlist").html(list);
            }
        });
    }
    ;


</script>
@endsection
@section('bodycontent')
<section id="doctor" class="home-section bg-gray paddingbot-60">
    <div class="container marginbot-50">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-2">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="section-heading text-center">
                        <h2 class="h-bold">Select Doctor Based On Speciality</h2>

                        <div class="form-group">

                            <select name="specialist" id="specialist" class="form-control input-md" onchange="loaddoct()" placeholder="Specialist" required="">
                                <option value="">Select Speciality</option>
                                @foreach ($specialty as $val)
                                <option value ="{{ $val->specialty}}">{{ $val->specialty }}</option>
                                @endforeach

                            </select>

                            <div class="validation"></div>
                        </div>
                    </div>
                </div>
                <div class="divider-short"></div>
            </div>
        </div>
    </div>
    
 
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

               
                
                <div id="grid-container" class="cbp-l-grid-team" >
                    
                    <ul id="doctlist">
                        @foreach ($doctors as $doctor) 
                        <li class="cbp-item psychiatrist">
                            <a href="singledoctor?doctorid={{$doctor->doctor_id}}" class="cbp-caption">
                                <div class="cbp-caption-defaultWrap">
                                    <img src="{{URL::to('/')}}/public/doctors/{{$doctor->doctor_photo}}" alt="" width="100%" height="100%">
                                </div>
                                <div class="cbp-caption-activeWrap">
                                    <div class="cbp-l-caption-alignCenter">
                                        <div class="cbp-l-caption-body">
                                            <div class="cbp-l-caption-text">VIEW PROFILE</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <p>{{$doctor->name}}({{$doctor->designation}})</p>
                            <p>{{$doctor->qualifications}}.</p>
                            <p>{{$doctor->address}}.</p>


                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
