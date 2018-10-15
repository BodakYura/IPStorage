<?php

namespace IPStorage;

/**
 * Interface IPStorageInterface
 * @package IPStorage
 */
interface IPStorageInterface
{
    /**
     * @param string $ip
     * @return int
     */
    public function add(string $ip);

    /**
     * @param string $ip
     * @return int
     */
    public function getCount(string $ip) : int;
}