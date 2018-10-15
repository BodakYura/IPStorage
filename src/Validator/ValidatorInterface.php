<?php

namespace IPStorage\Validator;

interface ValidatorInterface
{

    public function validate(string $ip): array;

}