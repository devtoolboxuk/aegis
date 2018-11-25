<?php

namespace Aegis\Db;

use Aegis\Db\Adapter\AdapterFactory;

class DBManager
{
    protected $adapter;
    protected $adapterName;

    function __construct($options)
    {
        $this->adapterName = $options['adapter'];
        $factory = AdapterFactory::instance();
        $this->adapter = $factory->getAdapter($options['adapter'], $options);
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