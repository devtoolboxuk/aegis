<?php

namespace Aegis\Aegis\Adapter;

use Doctrine\DBAL\Connection;

class AegisFactory
{
    protected static $instance;

    protected $adapters = [
        'fail2ban' => 'Aegis\Aegis\Adapter\fail2banAdapter'
    ];

    public static function instance()
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function registerAdapter($name, $class)
    {
        if (!is_subclass_of($class, 'Aegis\Aegis\Adapter\AegisInterface')) {
            throw new \RuntimeException(sprintsf(
                'Adapter class "%s" must implement Aegis\\Aegis\\Adapter\\AegisInterface',
                $class
            ));
        }
        $this->adapters[$name] = $class;

        return $this;
    }

    public function getAdapter($name, Connection $conn)
    {
        $class = $this->getClass($name);

        return new $class($conn);
    }

    protected function getClass($name)
    {
        if (empty($this->adapters[$name])) {
            throw new \RuntimeException(sprintf(
                'Adapter "%s" has not been registered',
                $name
            ));
        }

        return $this->adapters[$name];
    }
}
