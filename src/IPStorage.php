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
     * @return IPStorage
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
     * @return array
     */
    public function add(string $ip): array
    {
        $errors = $this->validator->validate($ip);

        if (count($errors) === 0) {
            $this->driver->save($ip);

            return ['count' => $this->getCount($ip)];
        }

        return ['errors' => $errors];
    }

    /**
     * @param string $ip
     * @return array
     */
    public function getCount(string $ip): array
    {
        $errors = $this->validator->validate($ip);

        if (count($errors) === 0) {
             $count = $this->driver->getCount($ip);

            return ['count' => $count];
        }

        return ['errors' => $errors];
    }

}
