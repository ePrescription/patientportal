<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>letter</title> 
        <!-- For-Mobile-Apps-and-Meta-Tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Clinical Care Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, SmartPhone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <script>
            function print(id) {

                var divToPrint = document.getElementById(id);

                var newWin = window.open('', 'Print-Window');

                newWin.document.open();

                newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

                newWin.document.close();

                // setTimeout(function(){newWin.close();},10);

            }

        </script>
    </head>

    @if( session('userID') && time()-session('logintime')<300)
    {{ session(['logintime' => time()])}}
    <body class="bg">
 
        <div class="modal-body" id='label'>
                   <center>
                     <br>
        
        

        <table style='width:100%;height:180px;border-color:black;border-width:1px;' >
            <tr bgcolor='#063751' style='color:white;font-size:10px'> <th colspan='6' ><center>{{ $doctorappointments[0]->hospital_name}}<span></span></center> </th></tr>
            <tr style='font-size:10px'> <td > Patient ID</td><td> :</td><td style='width:25%;'><span >{{session('patient_id')}}</span></td><td style='width:10%;'> Date</td><td> :</td><td><span >{{ date('d-m-Y',strtotime($doctorappointments[0]->appointment_date))}} {{ $doctorappointments[0]->time}}</span></td></tr>
            <tr style='font-size:10px'><td>Name </td><td>:</td><td colspan='3'> <span > {{session('userID')}}</span></td></tr>
            <tr style='font-size:10px'><td>Address </td><td>:</td><td> <span> </span></td><td>Gender </td><td>:</td><td> <span> </span></td></tr>
            <tr style='font-size:10px'><td>Mobile / Phone No </td><td>:</td><td colspan='3'> <span></span></td></tr>
            <tr style='font-size:10px'><td>Referred By </td><td>:</td><td colspan='5'> <span>{{ $doctorappointments[0]->name }}({{ $doctorappointments[0]->specialty}})</span></td></tr>
            <tr style='font-size:9px'><td colspan='5'> </td><td>Authorized Signatory </td></tr>
            <tr style='font-size:8px'><td colspan='5'> </td></tr>
            <tr > <th colspan='6' bgcolor='#063751' style='color:white;font-size:10px'><center>{{$doctorappointments[0]->hsaddress}}<span> </span> </center> </th></tr>

        </table> 
        <br>
        
        <table style='width:100%;height:180px;border-color:black;border-width:1px;' >
            <tr bgcolor='#063751' style='color:white;font-size:10px'> <th colspan='6' ><center>{{ $doctorappointments[0]->hospital_name}}<span></span></center> </th></tr>
            <tr style='font-size:10px'> <td> Patient ID</td><td> :</td><td style='width:25%;'><span >{{session('patient_id')}}</span></td><td style='width:10%;'> Date</td><td> :</td><td><span >{{ date('d-m-Y',strtotime($doctorappointments[0]->appointment_date))}} {{ $doctorappointments[0]->time}}</span></td></tr>
            <tr style='font-size:10px'><td>Name </td><td>:</td><td colspan='3'> <span > {{session('userID')}}</span></td></tr>
            <tr style='font-size:10px'> <td > Bed Name</td><td> :</td><td style='width:25%;'><span >{{session('patient_id')}}</span></td><td style='width:10%;'> Bed Name</td><td> :</td><td><span ></span></td></tr>
            <tr style='font-size:10px'><td>Attendant Name </td><td>:</td><td> <span></span></td></tr>

            <tr style='font-size:10px'><td>Age </td><td>:</td><td> <span> </span></td><td>Sex </td><td>:</td><td> <span> </span></td></tr>
            <tr style='font-size:10px'><td>Address </td><td>:</td><td> <span></span></td></tr>

            <tr style='font-size:10px'><td>Mobile / Phone No </td><td>:</td><td> <span></span></td></tr>

            <tr style='font-size:8px'><td colspan='5'> </td></tr>
            <tr style='font-size:9px'><td colspan='5'> </td><td>Authorized Signatory </td></tr>
            <tr > <th colspan='6' bgcolor='#063751' style='color:white;font-size:10px'><center>{{$doctorappointments[0]->hsaddress}}<span> </span> </center> </th></tr>

        </table> 

    </center>
        </div>
         <input type='button' class='button' value='Print' onclick="print('label')"/>   <input type='button' class='button' value='close' onclick="closeqrmodel('qrimageID')"/>


</body>
@else
@include('welcome')

@endif
</html>