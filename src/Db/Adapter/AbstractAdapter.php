<?php

namespace Aegis\Db\Adapter;
/**
 * Base Abstract Database Adapter.
 */
abstract class AbstractAdapter implements AdapterInterface
{

    /**
     * @var array
     */
    protected $dbOptions = [];

    protected $fireWallTable = 'firewall';

    protected $connection;

    public function __construct(array $options)
    {
        $this->setDbOptions($options);
    }

    public function setDbOptions(array $options)
    {
        $this->dbOptions = $options;
        return $this;
    }

    public function getDbOptions()
    {
        return $this->dbOptions;
    }

    public function hasDbOption($name)
    {
        return isset($this->options[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function getDbOption($name)
    {
        if (!$this->hasDbOption($name)) {
            return null;
        }

        return $this->dbOptions[$name];
    }

    public function getFireWallTable()
    {
        return $this->fireWallTable;
    }


    public function setFireWallTable($fireWallTable)
    {
        $this->fireWallTable = $fireWallTable;
        return $this;
    }

}
