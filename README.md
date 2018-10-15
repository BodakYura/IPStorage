# IPStorage

Small flexible library for stored ip address.

## Install

Via Composer

``` bash
$ composer require bodakyuriy/ipstorage:dev-develop
```

## Documentation

#### Basic usage of `ipstorage` client
```php
    use IPStorage\IPStorage;
    use IPStorage\Drivers\PDODriver\Driver\PDODriver;
    
    //Create instance of IPStorage           
    $ipStorage = new IPStorage();
    
    //Create instance of storage driver from box PDODriver
    $storageDriver = new PDODriver('sqlite:ip_store.sqlite3'); 
    
    /**
     * Set storage driver to IPStore  which it will use for stored ip addresses.
     * You can set your drivers which implements StorageDriverInterface 
     */
    $ipStorage->driver($storageDriver);
    
    //Store IP address and return count of stored 
    $ipStorage->add('127.0.0.1');
    
    //Return count of stored 
    $ipStorage->getCount('127.0.0.1');
```    
#### Optionally usage of `ipstorage` client
```php    
    use IPStorage\IPStorage;
    use IPStorage\Drivers\PDODriver\Driver\PDODriver;
        
    //Create instance of IPStorage           
    $ipStorage = new IPStorage();
    
    /**
     * Library use default ip validator but you can replace it your own validator which implemens ValidatorInteraface
     */
     $ipStorage->validator($validator);
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
