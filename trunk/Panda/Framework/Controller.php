<?php 

class Panda_Framework_Controller 
{
    private static $Instance;
    private static $uri = array();
    
    public static function init() 
    {
        if (self::$Instance === null) {
        	self::getURI();
            
            $controllerClass = Panda_Framework::PROJECT_NAME . '_Controller_' . ucfirst(self::getControllerName());
            $actionName      = self::getActionName();
            
            if (Panda::load($controllerClass)) {
                self::$Instance = new $controllerClass;
                Panda_Registry::getInstance()->Controller = self::$Instance;
            }
            else {
                throw new Exception('Invalid controller');
            }
            
            if (!method_exists(self::$Instance, $actionName)) {
                throw new Exception("Invalid action: $actionName");
            }
            
            self::$Instance->View = @new Panda_Framework_View;
            call_user_func_array(array(self::$Instance, $actionName), self::getParams());
            self::$Instance->View->render();
        }
    }
    
    public static function getURI($asPath = false)
    {
        if (!array_key_exists('raw', self::$uri)) {
            // Subtract the directory of SCRIPT_NAME from the REQUEST_URI
            $raw = str_replace(dirname($_SERVER['SCRIPT_NAME']), '', $_SERVER['REQUEST_URI']);
            
            // Sometimes /index.php is left behind, sometimes not.
            $raw = str_replace('/index.php', '', $raw);
            
            // Strip the query string, too (it's still available, don't worry)
            $raw = str_replace($_SERVER['QUERY_STRING'], '', $raw);

            // Replace duplicates
            $raw = preg_replace('/\/\/+/', '/', $raw);
            
            // Replace invalid chars
            $raw = preg_replace('/[^a-zA-Z0-9\-_\.\/]/', '', $raw);
            
            // Remove first and last slashes
            $raw = preg_replace('/(^\/|\/$)/', '', $raw);
            
            if (!empty($raw)) {
                self::$uri['raw'] = explode('/', $raw);
            }
            else {
                self::$uri['raw'] = array();
            }
        }
        
        if ($asPath) {
            return implode('/', self::$uri['raw']);
        }
        else {
            return self::$uri['raw'];
        }
    }
    
    public static function getControllerName()
    {
        if (!array_key_exists('controller', self::$uri)) {
            
            if (count(self::$uri['raw']) > 0) {
                self::$uri['controller'] = self::$uri['raw'][0];
            }
            else {
                $defaultController = Panda_Configuration::getInstance()->defaultController;
                
                if (!empty($defaultController)) {
                    self::$uri['controller'] = $defaultController;
                }
                else {
                    throw new Exception('Unable to discover default controller');
                }
            }
        }
        
        return self::$uri['controller'];
    }
    
    public static function getActionName() 
    {
        if (!array_key_exists('action', self::$uri)) {
            if (count(self::$uri['raw']) > 1) {
                self::$uri['action'] = self::$uri['raw'][1];
            }
            else {
                $defaultAction = Panda_Configuration::getInstance()->defaultAction;
                
                if (!empty($defaultAction)) {
                    self::$uri['action'] = $defaultAction;
                }
                else {
                    throw new Exception('Unable to discover default action');
                }
            }
        }
        
        return self::$uri['action'];
    }
    
    public static function getParams()
    {
        if (!array_key_exists('params', self::$uri)) {
            $componentCount = count(self::$uri['raw']);
            self::$uri['params'] = array();
            
            if ($componentCount > 2) {
                for ($i = 2; $i < $componentCount; $i++) {
                    self::$uri['params'][] = self::$uri['raw'][$i];
                }
            }
            else {
                self::$uri['params'] = null;
            }
        }
        
        return self::$uri['params'];
    }
}

?>