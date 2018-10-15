<?php

namespace IPStorage;

use IPStorage\Drivers\StorageDriverInterface;
use IPStorage\Validator\Validator;
use IPStorage\Validator\ValidatorInterface;

/**
 * Class IPStorage
 * @package IPStorage
 */
class IPStorage implements IPStorageInterface
{
    /**
     * @var StorageDriverInterface
     */
    private $driver;
    /**
     * @var Validator
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
     * @return $this
     */
    public function driver(StorageDriverInterface $storageDriver): self
    {
        $this->driver = $storageDriver;

        return $this;
    }

    /**
     * @param ValidatorInterface $validator
     * @return IPStorage
     */
    public function validator(ValidatorInterface $validator): self
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * @param string $ip
     * @return array|int
     */
    public function add(string $ip): array
    {
        $errors = $this->validator->validate($ip);

        if (count($errors) === 0) {
            $this->driver->save($ip);
        } else {
            return ['errors' => $errors];
        }

        return ['count' => $this->getCount($ip)];
    }

    /**
     * @param string $ip
     * @return int
     */
    public function getCount(string $ip): int
    {
        return $this->driver->getCount($ip);
    }

}
