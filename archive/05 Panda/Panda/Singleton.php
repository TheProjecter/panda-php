<?php

abstract class Panda_Singleton
{
    final protected function __construct() {}
    final private function __clone() {}
    
    abstract public static function getInstance();
}

class Foo extends Panda_Singleton
{
    private static $Instance;
    
    public static function getInstance() {
        if (!self::$Instance) {
            self::$Instance = new self;
        }
        
        return self::$Instance;
    }
}

?>