<?php
namespace App\patientportal\modal;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sms
 *
 * @author glodeveloper
 */
class Sms {
    //put your code here
    public Static function sendMSG($no, $txt) {
       
        $txt = str_replace(" ", "%20", $txt);
        $txt = str_replace(":", "%3A", $txt);
//      $smsurl="http://mysms.glovision.co/api/transsms.php?to=".$no."&message=".$txt."&username=".$accountID;
       // $smsurl = "http://sms.serverbasket.com/sendsms.asp?user=glovision&password=Gl0v1\$ion&sender=GLOVSN&text=" . $txt . "&PhoneNumber=" . $no . "&track=1";
        $smsurl="http://bhashsms.com/api/sendmsg.php?user=Daiwiksoft&pass=Daiwik2612&sender=daiwik&phone=".$no."&text=".$txt."&priority=ndnd&stype=normal";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $smsurl);
        //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      //  curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1);
        //curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        curl_exec($ch);
        error_log($smsurl);
       
    }

}
