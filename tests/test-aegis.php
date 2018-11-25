<?php

namespace Aegis;

use PHPUnit\Framework\TestCase;

#use Aegis\Db\DoctrineAdapter;

class AegisTest extends TestCase
{

    function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

    }

    function testAegis()
    {
        $options = [
            'database' => [
                'adapter' => 'mysql',
                'driver' => 'mysqli',
                'user' => 'root',
                'password' => 'superdry',
                'dbname' => 'superdry',
                'host' => 'database'
            ]
        ];

        $aegis = new Aegis($options);
        $fail2ban = $aegis->getService('fail2ban');

        if (!$fail2ban->isWhiteListed('192.168.0.1')) {
            $fail2ban->addIpAddress('192.168.0.1');
        }
        //

    }

}
