<?php

namespace IPStorage\Drivers\PDODriver\Entity;

class IPStore
{
    protected $id;

    protected $ip;

    protected $count;

    public function getId()
    {
        return $this->id;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    public function getCount()
    {
        return $this->count;
    }
}