<?php 

class Panda_Request extends Panda_Collection {
    
    private static $Instance;
    
    protected function __construct() {
    	// Get a reference to the request variable
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    		$gp =& $_GET;
    	} else {
    		$gp =& $_POST;
    	}
    	
    	// Extract the first query key+value pair
    	// The key will always contain the controller request
    	list($key, $value) = each($gp);
    	$temp = explode('?', $key);
    	$uri  = array_shift( $temp );
    	$key  = implode('?', $temp);
    	
    	// Re-insert the first query key+value pair
    	array_shift($gp);
    	$gp[ $key ] = $value;
    	
    	// Replace duplicates
        $uri = preg_replace('/\/\/+/', '/', $uri);
        // Remove first and last slashes
        $uri = preg_replace('/(^\/|\/$)/', '', $uri);
        $uri = (!empty($uri))? explode('/', $uri) : array();

		// Save off the values.
        $this->raw            = $uri;
        $this->controllerName = array_shift($uri);
        $this->actionName     = array_shift($uri);
        $this->params         = $uri;
        $this->query          = $gp;
    }
    
    private final function __clone() {}
    
    public static function getInstance() {
        if (!self::$Instance instanceof self) {
            self::$Instance = new self;
        }
        
        return self::$Instance;
    }
    
    
    
	public function getControllerName() {
		if (empty($this->controllerName)) {
			$this->controllerName = Panda_Configuration::getInstance()->defaultController;
		}
		
		return Panda_Framework::PROJECT_NAME . '_Controller_' . $this->controllerName;
	}
	
	public function getActionName() {
		if (empty($this->actionName)) {
			$this->actionName = Panda_Configuration::getInstance()->defaultAction;
		}
		
		return $this->actionName;
	}
	
	public function getParams() {
		return $this->params;
	}
	
	public function getQuery() {
		return $this->query;
	}
    
}

?>