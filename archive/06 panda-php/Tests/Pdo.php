<?php

require 'setup.php';
require '../Panda/Pdo.php';

class Test_Pdo
extends Panda_Pdo
{
    protected $driver = 'mysql';
    protected $hostname = 'localhost';
    protected $username = 'root';
    protected $password = '';
    protected $database = 'ActiveRecord';
}

$db = new Test_Pdo;

$Statement = $db->prepare('SELECT * FROM Test');
$Statement->execute();
$Statement->setFetchMode( PDO::FETCH_OBJ );

print_r($Statement->fetchAll());

?>