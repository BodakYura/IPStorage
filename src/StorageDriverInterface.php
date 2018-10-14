<?php

namespace IPStorage;

interface StorageDriverInterface
{
    public function save(string $ip) : bool ;

    public function getCount(string $ip) : int ;
}