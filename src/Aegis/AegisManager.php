<?php

namespace Aegis\Aegis;

use Aegis\Aegis\Adapter\AegisFactory;
use Doctrine\DBAL\Connection;

class AegisManager
{
    protected $adapter;
    protected $adapterName;
    protected $conn;

    function __construct($adapterName, Connection $conn)
    {
        $this->adapterName = $adapterName;
        $factory = AegisFactory::instance();
        $this->adapter = $factory->getAdapter($adapterName, $conn);
    }

    public function getAdapter()
    {
        if (isset($this->adapter)) {
            return $this->adapter;
        } else {
            throw new \RuntimeException(sprintf('The specified %s is not configured', $this->adapterName));
        }

    }

}