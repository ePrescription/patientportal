<html>
    <title>

    </title>
    <head>
        <style>
            
            </STYLE>
    </head>
<body background="images/banner2.jpg">
        <div id='SDD'>
        <p> 
            Dear  {{$pharmacyinfo[0]->name}}<br>

                Pharmacy appointment for {{session('userID')}}, regarding {{$briefnote}},<br>
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