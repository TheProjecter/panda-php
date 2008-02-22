<?php 

class Panda_Util_Request extends Panda_Util_Collection {
    
    private static $Instance;
    
    private final function __construct() {
        $this->captureRequestData();
        $this->captureFileData();
	}
	
    private final function __clone() {}
    
    public static function getInstance() {
        if (!self::$Instance) {
            self::$Instance = new Panda_Util_Request;
        }
        
        return self::$Instance;
    }
	
	private function captureRequestData() {
	    foreach ($_REQUEST as $key => $value) {
           $this->__set($key, $value);
	    }
	}
	
	private function captureFileData() {
	    foreach ($_FILES as $key => $value) {
            $this->__set($key, new Panda_Util_Request_File($value));
	    }
	}
	
}

?>