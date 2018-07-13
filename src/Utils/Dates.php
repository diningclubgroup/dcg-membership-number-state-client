<?php

namespace Dcg\Client\MembershipNumberStateClient\Utils;

use Dcg\Api\MembershipNumberState\Queue\MembershipNumberStateQueue;
use App\Jobs\EEAPIActivateRequestJob;
use App\Jobs\EEAPIDeactivateRequestJob;
use Log;

class Dates
{
    static public function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);  // carbon?
        return $d && $d->format($format) == $date;
    }
}