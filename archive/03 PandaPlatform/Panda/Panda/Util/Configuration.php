<?php

class Panda_Util_Configuration extends Panda_Util_Collection {
    private static $Instance;
    
    private final function __construct() {}
    private final function __clone() {}
    
    public static function getInstance() {
        if (!self::$Instance) {
            self::$Instance = new Panda_Util_Configuration;
        }
        
        return self::$Instance;
    }    
}

?>