<?php

namespace Aegis\Db\Adapter;

use Doctrine\DBAL\DriverManager;

class DoctrineAdapter extends AbstractAdapter implements AdapterInterface
{

    function connection()
    {
        return DriverManager::getConnection($this->dbOptions);
    }
}