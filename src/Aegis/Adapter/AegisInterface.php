<?php

namespace Aegis\Aegis\Adapter;

interface AegisInterface
{
    public function tableExists($class, string $tableName);
}
