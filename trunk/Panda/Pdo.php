<?php

class Panda_Pdo
    extends PDO
{
    protected $driver;
    protected $hostname;
    protected $username;
    protected $password;
    protected $database;

    public function __construct()
    {
        $dsn = "$this->driver:dbname=$this->database;host=$this->hostname";
        parent::__construct($dsn, $this->username, $this->password);
    }
}

?>
