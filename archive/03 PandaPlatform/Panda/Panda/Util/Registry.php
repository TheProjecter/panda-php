<?php 

class Panda_Util_Registry extends Panda_Util_Collection {
    
    private static $Instance;
    
    private final function __construct() {}
    private final function __clone() {}
    
    public static function getInstance() {
        if (!self::$Instance) {
            self::$Instance = new Panda_Util_Registry;
        }
        
        return self::$Instance;
    }
    
}

?>