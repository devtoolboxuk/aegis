<?php

namespace Aegis;

use Aegis\Db\DBManager;
use Aegis\Aegis\AegisManager;


class Aegis
{

    protected $options;
    protected $conn;

    protected $aegisServices = [
        'fail2ban'
    ];

    function __construct($options)
    {
        $this->options = $options;
        $this->initManager();

    }

    private function initManager()
    {
        $this->setConn();
        $this->aegisServices();
    }

    function setConn()
    {
        $databaseService = new DBManager($this->options['database']);
        $this->conn = $databaseService->getAdapter()->connection();
    }

    private function aegisServices()
    {

        foreach ($this->aegisServices as $service) {
            $aegisServices = new AegisManager($service,$this->conn);
            $this->$service = $aegisServices->getAdapter();
        }

    }

    function getService($service)
    {
        return $this->$service;
    }
}