<?php

namespace IPStorage\Drivers;

/**
 * Interface StorageDriverInterface
 * @package IPStorage\Drivers
 */
interface StorageDriverInterface
{
    /**
     * @param string $ip
     * @return bool
     */
    public function save(string $ip) : bool ;

    /**
     * @param string $ip
     * @return int
     */
    public function getCount(string $ip) : int;
}