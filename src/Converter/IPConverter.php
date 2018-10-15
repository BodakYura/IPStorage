<?php

namespace IPStorage\Converter;


/**
 * Class IPConverter
 * @package IPStorage\Converter
 */
final class IPConverter
{
    /**
     * @param string $ip
     * @return mixed
     * @throws \Exception
     */
    public function IPToBinary(string $ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return current(unpack("A4", inet_pton($ip)));
        } elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return current(unpack("A16", inet_pton($ip)));
        }

        throw new \Exception("Please supply a valid IPv4 or IPv6 address");
    }

    /**
     * @param $str
     * @return bool|string
     * @throws \Exception
     */
    function BinaryToIP(string $str){
        if( strlen( $str ) == 16 OR strlen( $str ) == 4 ){
            return inet_ntop( pack( "A".strlen( $str ) , $str ) );
        }

        throw new \Exception( "Please provide a 4 or 16 byte string" );
    }
}