<?php

namespace IPStorage;

use IPStorage\Drivers\StorageDriverInterface;
use IPStorage\Validator\ValidatorInterface;

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
    public function getCount(string $ip): array;

    /**
     * @param ValidatorInterface $validator
     * @return IPStorageInterface
     */
    public function validator(ValidatorInterface $validator): self;

    /**
     * @param StorageDriverInterface $storageDriver
     * @return IPStorageInterface
     */
    public function driver(StorageDriverInterface $storageDriver): self;

}