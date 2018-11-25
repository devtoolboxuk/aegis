<?php

namespace Aegis\Db\Table;

class fail2ban extends Table
{

    const QUERY_CREATE_TBL = "CREATE TABLE `fail2ban` (
              `ip_address` int(20) NOT NULL,
              `whitelist` boolean DEFAULT false,
              `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    function createTable()
    {
        $this->getConn()->exec(SELF::QUERY_CREATE_TBL);
    }

}