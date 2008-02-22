<?php 

if (!defined('PROJECT_DIR')) {
    throw new Exception('Unable to discover project directory.');
}

class Panda_Framework {
    private static $classInstances = array();
    
    public static function bootstrap()
    {
        self::setProjectName();
        
        $Registry = Panda_Util_Registry::getInstance();
        $Registry->Request = Panda_Util_Request::getInstance();
        $Registry->Configuration = Panda_Util_Configuration::getInstance();
        
        self::loadConfiguration();
        
        Panda_Framework_Controller::init();
    }
    
    private static function loadConfiguration()
    {
        $configurationPath = PROJECT_DIR . DIRECTORY_SEPARATOR . PROJECT_NAME . '.php';
        
        if (is_file($configurationPath)) {
            $Configuration = Panda_Util_Registry::getInstance()->Configuration;
            require $configurationPath;
        }
    }
    
    private static function setProjectName()
    {
        $components = explode(DIRECTORY_SEPARATOR, PROJECT_DIR);
        define('PROJECT_NAME', $components[count($components) - 1]);
    }
}

?>