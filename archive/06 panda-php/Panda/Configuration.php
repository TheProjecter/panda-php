<?php

class Panda_Configuration extends Panda_Collection {
    private static $Instance;
    
    public $defaultController = 'Front';
    public $defaultAction     = 'home';
    
    private final function __construct() {}
    private final function __clone() {}
    
    public static function getInstance() {
        if (!self::$Instance) {
            self::$Instance = new Panda_Configuration;
        }
        
        return self::$Instance;
    }    
}

?>