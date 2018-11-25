<?php

namespace Aegis\Aegis\Adapter;

use Aegis\Db\Table\fail2ban;
use Doctrine\DBAL\Connection;

//SELECT INET_NTOA(3232238130);
//SELECT INET_ATON('192.168.10.50');
//SELECT INET_ATON('192.168.10.50');
//http://magic-cookie.co.uk/iplist.html

class Fail2BanAdapter extends AegisAbstract implements AegisInterface
{

    protected $tableName = 'fail2ban';

    function __construct(Connection $conn)
    {
        parent::__construct($conn);
        $this->tableExists(new fail2ban($this->conn), $this->tableName);
    }

    function addIpAddress($ip_address)
    {
        $qb = $this->getConn()->createQueryBuilder();
        $qb->insert($this->tableName)
            ->setValue('ip_address', $this->ip2Long($ip_address));
        $qb->execute();
    }

    function whiteListIp($ip_address)
    {
        $qb = $this->getConn()->createQueryBuilder();
    }

    function isWhiteListed($ip_address)
    {
        $qb = $this->getConn()->createQueryBuilder();
        $qb->select('whitelist')
            ->from($this->tableName)
            ->where('ip_address=:ip_address')
            ->andWhere('whitelist = 1')
            ->setParameter('ip_address', $this->ip2Long($ip_address))
            ->setMaxResults(1);
        $result = $qb->execute();
        if ($result->rowCount() == 1) {
            return true;
        }
        return false;
    }
}