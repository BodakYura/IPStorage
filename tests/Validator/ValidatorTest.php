<?php

namespace IPStorage\Test\Validator;

use IPStorage\Validator\Validator;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    private $validator;

    protected function setUp()
    {
        $this->validator = new Validator();
    }

    public function testValidate()
    {
        $result = $this->validator->validate('192.168.1.1');

        $this->assertInternalType(IsType::TYPE_ARRAY, $result);
    }

    protected function tearDown()
    {
        $this->validator = NULL;
    }

}
