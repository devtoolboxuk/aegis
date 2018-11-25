<?php

namespace Aegis\Services;

class ipAddress
{

    public function ip2Long(string $ip_address)
    {
        return ip2long($ip_address);
    }

    public function long2ip(string $string)
    {
        return long2ip($string);
    }

}