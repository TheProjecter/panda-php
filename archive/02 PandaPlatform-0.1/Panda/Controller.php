<?php

class Panda_Controller
{
    private static $Instance;
    protected $View;
    
    public static function init() 
    {
        if (self::$Instance === null) {
            $Configuration  = Panda::getInstance('Panda_Configuration');
            $controllerName = Panda_RequestHandler::getControllerName();
            $actionName     = Panda_RequestHandler::getActionName();

            if (empty($controllerName)) {
                $controllerName = $Configuration->defaultController;
            }

            if (empty($actionName)) {
                $actionName = $Configuration->defaultAction;
            }

            $controllerName = self::getControllerClassName($controllerName);
            self::$Instance = new $controllerName;
            self::$Instance->View = new Panda_View;
            
            call_user_func_array(array(self::$Instance, $actionName), Panda_RequestHandler::getParams());
            self::$Instance->View->render();
        }
    }
    
    public static function getControllerClassName($controllerName)
    {
        return PROJECT_NAME . '_Controller_' . ucfirst($controllerName);
    }
}

?>