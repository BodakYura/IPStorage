<?php

namespace IPStorage\Drivers\DoctrineDriver;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Configuration;

class DoctrineDriver
{
    private $connection;

    public function __construct()
    {
        $config = new Configuration();
        $connectionParams = array(
            'url' => 'mysql://user:secret@localhost/mydb',
        );
        $this->connection = DriverManager::getConnection($connectionParams, $config);
    }
}