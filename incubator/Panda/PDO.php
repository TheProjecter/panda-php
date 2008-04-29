<?php

/**
 * PDO Wrapper
 *
 * @package Panda_PDO
 * @author Michael Girouard (mikeg@lovemikeg.com)
 */
class Panda_PDO
extends PDO
{
    /**
     * PDO driver
     * 
     * @var string
     */
    protected $driver;
    
    /**
     * Hostname
     * 
     * @var string
     */
    protected $hostname;
    
    /**
     * Username
     * 
     * @var string
     */
    protected $username;
    
    /**
     * Password
     * 
     * @var string
     */
    protected $password;
    
    /**
     * Database name
     * 
     * @var string
     */
    protected $database;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(
            "$this->driver:dbname=$this->database;host=$this->hostname",
            $this->username, 
            $this->password
        );
    }
    
    
}