<?php

namespace App\patientportal\services;

use App\patientportal\repositories\repoInterface\PharmaInterface;


/**
 * Created by PhpStorm.
 * User: glodeveloper
 * Date: 1/30/18
 * Time: 12:33 PM
 */
class PharmaService
{
    protected $pharmaRepo;

    public function __construct(PharmaInterface $pharmaRepo)
    {
        //   dd('Inside constructor');
        $this->pharmaRepo = $pharmaRepo;
    }

    public function BookPharmaAppointment($request)
    {


        $status = null;
        try {

            $status = $this->pharmaRepo->BookPharmaAppointment($request);


        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
            //$msg->sendUnExpectedExpectionResponse($exc);
        }
        return $status;

    }

    public function getAppointment($request)
    {

        $appointment = null;
        try {

            $appointment = $this->pharmaRepo->getAppointment($request);

        } catch (Exception $userExc) {

            $errorMsg = $userExc->getMessageForCode();

            $msg = AppendMessage::appendMessage($userExc);

        } catch (Exception $exc) {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            //error_log($status);
        }
        return $appointment;
    }
}
