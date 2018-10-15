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
     * @return array
     */
    public function add(string $ip): array;

    /**
     * @param string $ip
     * @return int
     */
    public function getCount(string $ip) : int;
}