<?php

namespace IPStorage\Test;

use IPStorage\Drivers\StorageDriverInterface;
use IPStorage\IPStorage;
use IPStorage\Validator\ValidatorInterface;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;

class IPStorageTest extends TestCase
{
    private $storage;

    protected function setUp()
    {
        $this->storage = new IPStorage();
    }

    public function testDriver()
    {
        $result = $this->storage->driver(new class() implements StorageDriverInterface
        {
            public function save(string $ip): bool
            {
                return true;
            }

            public function getCount(string $ip): int
            {
                return 1;
            }
        });

        $this->assertInstanceOf(IPStorage::class, $result);
    }

    public function testValidator()
    {
        $result = $this->storage->validator(new class() implements ValidatorInterface
        {
            public function validate(string $ip): array
            {
                return [];
            }
        });

        $this->assertInstanceOf(IPStorage::class, $result);
    }

    public function testAdd()
    {
        $this->storage->driver(new class() implements StorageDriverInterface
        {
            public function save(string $ip): bool
            {
                return true;
            }

            public function getCount(string $ip): int
            {
                return 1;
            }
        });

        $result = $this->storage->add('192.168.1.1');

        $this->assertInternalType(IsType::TYPE_ARRAY, $result);
    }

    public function testGetCount()
    {
        $this->storage->driver(new class() implements StorageDriverInterface
        {
            public function save(string $ip): bool
            {
                return true;
            }

            public function getCount(string $ip): int
            {
                return 1;
            }
        });

        $result = $this->storage->getCount('192.168.1.1');

        $this->assertInternalType(IsType::TYPE_ARRAY, $result);
    }

    protected function tearDown()
    {
        $this->storage = NULL;
    }

}
