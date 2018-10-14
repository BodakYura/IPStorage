<?php

namespace IPStorage;

interface ValidatorInterface
{

    public function validate(string $ip) : bool ;

}