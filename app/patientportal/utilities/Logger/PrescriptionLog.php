<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 31/03/2017
 * Time: 6:24 PM
 */

namespace App\patientportal\Utilities\Logger;

use App\patientportal\Utilities\Exception\BaseException;
use App\patientportal\Utilities\Exception\AppendMessage;
use Exception;
use Log;

class PrescriptionLog {

    public static function WritePrescriptionExceptionToLog(BaseException $baseExc)
    {
        $errorMsg = $baseExc->getMessageForCode();
        $msg = AppendMessage::appendMessage($baseExc);
        Log::error($msg);
        return $errorMsg;
    }

    public static function WriteGeneralExceptionToLog(Exception $exc)
    {
        $msg = AppendMessage::appendGeneralException($exc);
        Log::error($msg);
    }
}