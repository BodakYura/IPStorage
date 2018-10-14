<?php

namespace IPStorage\Drivers\PDODriver;

use IPStorage\StorageDriverInterface;

class PDODriver implements StorageDriverInterface
{
    private $connection;

    public function __construct($dsn, $username, $passwd)
    {
        $this->connection = new \PDO($dsn, $username, $passwd);
    }

    public function save(string $ip): bool
    {
        // TODO: Implement save() method.
    }

    public function getCount(string $ip): int
    {
        // TODO: Implement getCount() method.
    }
}
