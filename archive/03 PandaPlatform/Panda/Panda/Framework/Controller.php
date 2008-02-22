<?php 

class Panda_Framework_Controller {
    private static $Instance;
    private static $uri = array();
    
    public static function init() 
    {
        if (self::$Instance === null) {
            self::getURI();
            
            $controllerName  = self::getControllerName();
            $controllerClass = self::getControllerClassName($controllerName);
            $actionName      = self::getActionName();
            $params          = self::getParams();
            
            self::$Instance = new $controllerClass;
            
            if (!method_exists(self::$Instance, $actionName)) {
                throw new Exception('Invalid action');
            }
            
            call_user_func_array(array(self::$Instance, $action), $params);
        }
    }
    
    public static function getURI($asPath = false)
    {
        if (!array_key_exists('raw', self::$uri)) {
            $raw = preg_replace('/\/\/+/', '/', $_SERVER['QUERY_STRING']);
            $raw = preg_replace('/[^a-zA-Z0-9\-_\.\/]/', '', $raw);
            $raw = preg_replace('/^\//', '', $raw);
            
            self::$uri['raw'] = explode('/', $raw);
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
                die('nothing passed');
                $defaultController = Panda_Util_Configuration::getInstance()->defaultController;
                
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
                $defaultAction = Panda_Util_Configuration::getInstance()->defaultAction;
                
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
    
    public static function getControllerClassName($controllerName)
    {
        return PROJECT_NAME . '_Controller_' . ucfirst($controllerName);
    }
}

?>