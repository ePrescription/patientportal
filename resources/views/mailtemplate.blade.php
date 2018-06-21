<html>
    <title>

    </title>
    <head>
    </head>
<body background="images/banner2.jpg">
        <div id=''>
        <p>  Dear {{ session('userID') }},<br>

                Thanks for booking your appointment with  {{$doctor[0]->name}} ,<br>
                Here all the details you need  <BR>
            <h2>Brief Note</h2>
            <b>{{ $briefnote }}</b>
           
            <b></b>

            <h2>When</h2><br>
            <b>{{ $date }}{{ $time }}</b><br>

            <h2>Regards</h2>
            <b>{{$hospitalinfo[0]->hospital_name}}</b><br>
            <b>{{$hospitalinfo[0]->telephone}}</b><br>
             <b>{{$hospitalinfo[0]->email}}</b>

        </h2>
    </div>
</body>
</html>