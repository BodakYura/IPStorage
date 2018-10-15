<?php

namespace IPStorage\Validator;

/**
 * Interface ValidatorInterface
 * @package IPStorage\Validator
 */
interface ValidatorInterface
{

    /**
     * @param string $ip
     * @return array
     */
    public function validate(string $ip): array;

}