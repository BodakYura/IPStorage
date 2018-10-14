<?php

namespace IPStorage;

class Validator implements ValidatorInterface
{

    public function validate(string $ip): bool
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP) && !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return false;
        }

        return true;
    }

}