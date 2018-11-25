<?php

namespace Aegis\Db\Adapter;

class AdapterFactory
{
    protected static $instance;

    protected $adapters = [
        'mysql' => 'Aegis\Db\Adapter\DoctrineAdapter'
    ];

    public static function instance()
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Add or replace an adapter with a fully qualified class name.
     *
     * @throws \RuntimeException
     * @param  string $name
     * @param  string $class
     * @return $this
     */
    public function registerAdapter($name, $class)
    {
        if (!is_subclass_of($class, 'Aegis\Db\Adapter\AdapterInterface')) {
            throw new \RuntimeException(sprintf(
                'Adapter class "%s" must implement Aegis\\Db\\Adapter\\AdapterInterface',
                $class
            ));
        }
        $this->adapters[$name] = $class;

        return $this;
    }

    /**
     * Get an adapter instance by name.
     *
     * @param  string $name
     * @param  array $options
     * @return \Phinx\Db\Adapter\AdapterInterface
     */
    public function getAdapter($name, array $options)
    {
        $class = $this->getClass($name);

        return new $class($options);
    }

    /**
     * Get an adapter class by name.
     *
     * @throws \RuntimeException
     * @param  string $name
     * @return string
     */
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
