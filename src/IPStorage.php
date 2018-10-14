<?php

namespace IPStorage;

/**
 * Class IPStorage
 * @package IPStorage
 */
class IPStorage
{
    /**
     * @var array
     */
    private $drivers = [];
    /**
     * @var
     */
    private $defaultDriver;
    /**
     * @var Validator
     */
    private $validator;

    /**
     * IPStorage constructor.
     */
    public function __construct()
    {
        $this->validator = new Validator();
    }

    /**
     * @param string $key
     * @param StorageDriverInterface $storageDriver
     * @return $this
     */
    public function addStorageDriver(string $key, StorageDriverInterface $storageDriver)
    {
        $this->drivers[$key] = $storageDriver;

        return $this;
    }

    /**
     * @param string $driver
     * @return IPStorage
     */
    public function setStorageDriver(string $driver) : self
    {
        $this->defaultDriver = $driver;

        return $this;
    }

    /**
     * @return StorageDriverInterface
     */
    public function getStorageDriver(): StorageDriverInterface
    {
        return $this->drivers[$this->defaultDriver];
    }

    /**
     * @return array
     */
    public function getAvailableDrives(): array
    {
        return array_keys($this->drivers);
    }

    /**
     * @param ValidatorInterface $validator
     * @return IPStorage
     */
    public function setValidator(ValidatorInterface $validator) : self
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * @param string $ip
     * @return int
     */
    public function add(string $ip): int
    {
        $isValid = $this->validator->validate($ip);

        if ($isValid) {
            $this->getStorageDriver()->save($ip);
        }

        return $this->getStorageDriver()->getCount($ip);
    }

    /**
     * @param string $ip
     * @return int
     */
    public function getCount(string $ip): int
    {
        return $this->getStorageDriver()->getCount($ip);
    }

}
