<?php 

class Panda_Framework 
{
	
	/**
	 * The current project name.
	**/
	const PROJECT_NAME = PANDA_FRAMEWORK_PROJECT_NAME;
	
    public static function launch()
    {
        // Register some key classes
		self::loadRegistry();
        
        // Attempt to load the user-defined configuration files
		self::loadProjectConfiguration();
        
        // Initialize a controller and let it figure the rest out
        Panda_Command::execute();
    }
    
    private static function loadRegistry() {
        Panda::$Registry                = Panda_Registry::getInstance();
        Panda::$Registry->Request       = Panda_Request::getInstance();
        Panda::$Registry->Configuration = Panda_Configuration::getInstance();
    }
    
    private static function loadProjectConfiguration() {
		$configurationPath = (
			Panda::ROOT_DIR . DS . self::PROJECT_NAME . DS . self::PROJECT_NAME . '.php'
	    );
        
        if (is_file($configurationPath)) {
            require $configurationPath;
        }
    }
}
