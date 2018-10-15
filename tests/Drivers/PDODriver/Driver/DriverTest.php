<?php

namespace IPStorage\Test\Drivers\PDODriver\Driver;

use IPStorage\Drivers\PDODriver\Driver\PDODriver;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;

class DriverTest extends TestCase
{
    private $driver;

    protected function setUp()
    {
        $this->driver = new PDODriver('sqlite:test_store.sqlite3');
    }

    public function testSave()
    {
        $result = $this->driver->save('192.168.1.1');

        $this->assertInternalType(IsType::TYPE_BOOL, $result);
    }

    public function testGetCount()
    {
        $result = $this->driver->getCount('192.168.1.1');

        $this->assertInternalType(IsType::TYPE_INT, $result);
    }

    public function testFindByIP()
    {
        $result = $this->invokeMethod($this->driver, 'findByIp', ['192.168.1.1']);

        $this->assertInternalType(IsType::TYPE_BOOL, $result);
    }

    public function testUpdateIpCount()
    {
        $result = $this->invokeMethod($this->driver, 'updateIPCount', ['192.168.1.1']);

        $this->assertInternalType(IsType::TYPE_BOOL, $result);
    }

    public function testCreateIPStoreTable()
    {
        $result = $this->invokeMethod($this->driver, 'createIPStoreTable');

        $this->assertInternalType(IsType::TYPE_BOOL, $result);
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }


    protected function tearDown()
    {
        $this->driver = NULL;
    }


}
