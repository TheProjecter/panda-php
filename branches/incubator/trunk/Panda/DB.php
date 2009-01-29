<?php

class Panda_DB
extends PDO
{
    const DSN_TEMPLATE = '%s:dbname=%s;host=%s';

    protected $driver;
    protected $database;
    protected $username;
    protected $password;
    protected $hostname;

    public function __construct()
    {
        if ($this->driver === null ||
            $this->database === null ||
            $this->username === null ||
            $this->password === null ||
            $this->hostname === null) {
            
            throw new Exception('Unable to initialize a database connection: Invalid configuration.');
        }

        $dsn = sprintf(
            self::DSN_TEMPLATE,
            $this->driver,
            $this->database,
            $this->hostname
        );

        parent::__construct($dsn, $this->username, $this->password);
    }
}