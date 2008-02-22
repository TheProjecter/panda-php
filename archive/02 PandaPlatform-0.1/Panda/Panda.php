<?php

class Panda 
{
    private static $classInstances = array();
    
    public static function bootstrap()
    {
        self::setProjectName();
        
        set_include_path(dirname(PANDA_DIR) . ':' . get_include_path());
        spl_autoload_register(array('Panda','load'));
        
        self::register('Panda_RequestHandler');
        self::register('Panda_Configuration');
        
        Panda_RequestHandler::parseURI();
        Panda_Controller::init();
    }
    
    public static function setProjectName()
    {
        $components = explode(DIRECTORY_SEPARATOR, PROJECT_DIR);
        define('PROJECT_NAME', $components[count($components) - 1]);
    }
    
    public static function register($className, $customKey = null) 
    {
        if (!$customKey) {
            return self::$classInstances[$className] = new $className;
        }
        else {
            return self::$classInstances[$customKey] = new $className;
        }
    }
    
    public static function getInstance($className)
    {
        if (array_key_exists($className, self::$classInstances)) {
            return self::$classInstances[$className];
        }
        else {
            return null;
        }
    }
    
    public static function load($className, $extension = '.php')
    {
        $components = explode('_', $className);
        $classPath = implode(DIRECTORY_SEPARATOR, $components) . $extension;
        
        require $classPath;
    }
}

?>