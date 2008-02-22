<?php

class Panda_RequestHandler {
    private static $uri = array();
    
    public static function parseURI() 
    {
        self::getURI();
        self::getControllerName();
        self::getActionName();
        self::getParams();
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
                self::$uri['controller'] = null;
            }
        }
        
        if (!empty(self::$uri['controller'])) {
            return self::$uri['controller'];
        }
        else {
            return Panda::getInstance('Panda_Configuration')->defaultController;
        }
    }
    
    public static function getActionName() 
    {
        if (!array_key_exists('action', self::$uri)) {
            if (count(self::$uri['raw']) > 1) {
                self::$uri['action'] = self::$uri['raw'][1];
            }
            else {
                self::$uri['action'] = null;
            }
        }
        
        if (!empty(self::$uri['action'])) {
            return self::$uri['action'];
        }
        else {
            return Panda::getInstance('Panda_Configuration')->defaultAction;
        }
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