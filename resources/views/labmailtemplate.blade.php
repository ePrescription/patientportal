<html>
    <title> </title>
   
<body background="images/banner2.jpg">
        <div id='CC'>
        <p> 
           

                Lab appointment for {{session('userID')}}, regarding {{$testinfo['test_name']}},{{$testinfo['id']}}<br>
                Here all the details you need  <BR>
            <h2>Brief Note</h2>
            <b>{{ $briefnote }}</b>
            <b></b>

            <h2>When</h2><br>
            <b>{{ $date }}</b><br>

            <h2>Regards</h2>
            <b>{{session('userID')}}</b><br>
              <b>{{session('email')}}</b>

  
    </div>
</body>
</html>