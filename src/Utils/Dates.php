<?php

namespace Dcg\Client\MembershipNumberState\Utils;

class Dates
{
    static public function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);  // carbon?
        return $d && $d->format($format) == $date;
    }
}