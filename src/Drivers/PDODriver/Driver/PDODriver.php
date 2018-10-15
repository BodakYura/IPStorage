<?php

namespace IPStorage\Drivers\PDODriver\Driver;

use IPStorage\Drivers\StorageDriverInterface;

/**
 * Class PDODriver
 * @package IPStorage\Drivers\PDODriver\Driver
 */
class PDODriver implements StorageDriverInterface
{
    /**
     * @var \PDO
     */
    private $connection;
    /**
     * @var string
     */
    private $tableName = 'ip_store';

    /**
     * PDODriver constructor.
     * @param string $dsn
     * @param string|null $username
     * @param string|null $passwd
     */
    public function __construct(string $dsn, string $username = null, string $passwd = null)
    {
        $this->connection = new \PDO($dsn, $username, $passwd);
        $this->createIPStoreTable();
    }

    /**
     * @param string $ip
     * @return bool
     */
    public function save(string $ip): bool
    {
        if ($this->findByIP($ip)) {
            return $this->updateIPCount($ip);
        }

        $query = "INSERT INTO $this->tableName (ip) VALUES (:ip)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':ip', $ip);

        return $stmt->execute();
    }


    /**
     * @param string $ip
     * @return int
     */
    public function getCount(string $ip): int
    {
        $query = "SELECT count FROM $this->tableName WHERE ip=?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $ip);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return (int)$result['count'];
    }

    /**
     * @param string $ip
     * @return bool
     */
    private function findByIP(string $ip): bool
    {
        $query = "SELECT * FROM $this->tableName WHERE ip=?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $ip);
        $stmt->execute();
        $res = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (is_array($res) && count($res) > 0) {
            return true;
        }

        return false;
    }

    /**
     * @param string $ip
     * @return bool
     */
    private function updateIPCount(string $ip): bool
    {
        $query = "UPDATE $this->tableName SET count = count + 1 WHERE ip = :ip";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':ip', $ip);

        return $stmt->execute();
    }

    /**
     * @return bool
     */
    private function createIPStoreTable(): bool
    {
        return $this->connection->exec(
            "BEGIN;
                       CREATE TABLE IF NOT EXISTS $this->tableName (
                          id INTEGER PRIMARY KEY AUTOINCREMENT,  
                          ip VARCHAR (39) UNIQUE, 
                          count INTEGER DEFAULT 1
                       );
                       CREATE UNIQUE INDEX IF NOT EXISTS idx_ip ON $this->tableName (ip);
                       COMMIT;"
        );
    }
}
