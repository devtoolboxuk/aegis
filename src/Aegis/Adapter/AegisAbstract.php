<?php

namespace Aegis\Aegis\Adapter;

use Aegis\Db\Table\Table;
use Aegis\Services\ipAddress;
use Doctrine\DBAL\Connection;


abstract class AegisAbstract implements AegisInterface
{

    protected $conn;
    protected $table;
    protected $ipAddress;

    function __construct(Connection $conn)
    {
        $this->conn = $conn;
        $this->table = new Table($conn);
        $this->ipAddress = new ipAddress();
    }

    function ip2Long($ip_address)
    {
        return $this->ipAddress->ip2Long($ip_address);
    }

    function long2ip($string)
    {
        return $this->ipAddress->long2ip($string);
    }


    function tableExists($class, string $tableName)
    {
        if (!$this->table->tableExists($tableName)) {
            $class->createTable();
        }
    }

    public function getConn()
    {
        return $this->conn;
    }

}
