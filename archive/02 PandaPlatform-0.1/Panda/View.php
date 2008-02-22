<?php

class Panda_View
{
    private $variables = array();
    
    public function __set($key, $value) 
    {
        $this->variables[$key] = $value;
    }
    
    public function __get($key)
    {
        if (array_key_exists($key, $this->variables)) {
            return $this->variables[$key];
        }
        
        return null;
    }
    
    public function getViewPath()
    {
        return PROJECT_DIR . 
            DIRECTORY_SEPARATOR . 'views' . 
            DIRECTORY_SEPARATOR . Panda_RequestHandler::getControllerName() .
            DIRECTORY_SEPARATOR . Panda_RequestHandler::getActionName() . '.html';
    }
    
    public function render() 
    {
        extract($this->variables);
        include $this->getViewPath();
    }
}

?>