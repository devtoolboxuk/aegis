<?php

namespace Aegis\Db\Table;

use Doctrine\DBAL\Connection;

class Table
{

    protected $conn;

    function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    function tableExists(string $tableName)
    {

        $schemaManager = $this->getConn()->getSchemaManager();
        if ($schemaManager->tablesExist($tableName) === true) {
            return true;
        } else {
            return false;
        }
    }

    function getConn()
    {
        return $this->conn;
    }

    function createFireWall()
    {

    }

}