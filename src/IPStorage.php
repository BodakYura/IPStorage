<?php

namespace IPStorage;

use IPStorage\Drivers\StorageDriverInterface;
use IPStorage\Validator\Validator;
use IPStorage\Validator\ValidatorInterface;

/**
 * Class IPStorage
 * @package IPStorage
 * @link https://github.com/BodakYura/IPStorage Documentation of IPStorage.
 */
class IPStorage implements IPStorageInterface
{
    /**
     * @var StorageDriverInterface
     */
    private $driver;
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * IPStorage constructor.
     */
    public function __construct()
    {
        $this->validator(new Validator());
    }

    /**
     * @param StorageDriverInterface $storageDriver
     * @return IPStorageInterface
     */
    public function driver(StorageDriverInterface $storageDriver): IPStorageInterface
    {
        $this->driver = $storageDriver;

        return $this;
    }

    /**
     * @param ValidatorInterface $validator
     * @return IPStorageInterface
     */
    public function validator(ValidatorInterface $validator): IPStorageInterface
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * @param string $ip
     * @return array
     */
    public function add(string $ip): array
    {
        $ip = trim($ip);
        $errors = $this->validator->validate($ip);

        if (count($errors) === 0) {
            $this->driver->save($ip);

            return ['count' => $this->driver->getCount($ip)];
        }

        return ['errors' => $errors];
    }

    /**
     * @param string $ip
     * @return array
     */
    public function getCount(string $ip): array
    {
        $ip = trim($ip);
        $errors = $this->validator->validate($ip);

        if (count($errors) === 0) {
             $count = $this->driver->getCount($ip);

            return ['count' => $count];
        }

        return ['errors' => $errors];
    }

}
