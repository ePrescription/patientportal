<html>
    <title>

    </title>
    <head>
    </head>
    <body background=../../public/images/banner2.jpg">
        <div id=''>
            <p>  Dear {{$doctor[0]->name}},<br>

            <h2>Subject</h2>
            <b>{{ $subject }}</b> <BR>
            <h2>Message</h2>
             {{ $msg }}

            <b></b>
            <h2>Patient Details</h2><br>
            <b>{{ session('patient_id') }}</b>
            <br>
            <b>{{ session('userID') }}</b>
            <h2>Regards</h2>
            <b>{{$hospitalinfo[0]->hospital_name}}</b><br>
            <b>{{$hospitalinfo[0]->telephone}}</b><br>
            <b>{{$hospitalinfo[0]->email}}</b>

        </h2>
    </div>
</body>
</html>