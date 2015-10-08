# Introduction #

`Panda_Pdo` is a simple class that extends PHP's native [PDO class](http://php.net/pdo/) and offers some additional functionality to simplify use.

# Using `Panda_Pdo` #

`Panda_Pdo` is an adapter and therefore only needs you to provide a few details for it to become fully functional. An example implementation is as follows:

```
<?php

class Example_Pdo
extends Panda_Pdo
{
    protected $driver   = 'mysql';
    protected $hostname = 'localhost';
    protected $username = 'example';
    protected $password = 'pass12345';
    protected $database = 'some_db';
}

?>
```

When `Example_Pdo` is instantiated, the constructor it inherits from `Panda_Pdo` will take care of the necessary details of establishing a connection using the information provided in your concrete class.