<?php

abstract class Panda_Command
{
    private $context;
    private $command;
    private $modifiers;
    
    public function __construct($context, $command, $modifiers) {
        $this->context = $context;
        $this->command = $command;
        $this->modifiers = $modifiers;
    }
    
    public function getContext() 
    {
        return $this->context;
    }
    
    public function getCommand()
    {
        return $this->command;
    }
    
    public function getModifiers()
    {
        return $this->modifiers;
    }
    
    //abstract public function execute();
    
    public static function execute() 
    {
    	$Request =& Panda::$Registry->Request;
    	
    	// Get the controller + action
    	$controller = $Request->getControllerName();
    	$action     = $Request->getActionName();
    	
    	// Attempt to load the controller
    	if (!Panda::load($controller)) {
    		throw new Panda_Exception('Missing Controller');
    	}
		self::$Instance = new $controller;
		Panda::$Registry->Controller = self::$Instance;
		
		// Determine if the requested action exists
		$reflectClass = new ReflectionClass(self::$Instance);
		if (!$reflectClass->hasMethod($action)) {
			throw new Panda_Exception('Missing Action');
		}
		
		// Determine if the request action is usable
    	$reflectMethod = $reflectClass->getMethod($action);
    	if (!$reflectMethod->isPublic() || $reflectMethod->isAbstract()) {
    		throw new Panda_Exception('Internal Action');
    	}
    	
    	// Instantiate the View, execute the action, and render the view
    	self::$Instance->View = new Panda_Framework_View;
    	$numRequired = $reflectMethod->getNumberOfRequiredParameters();
		$params      = array_pad($Request->getParams(), $numRequired, null);
		$reflectMethod->invokeArgs(self::$Instance, $params);
		self::$Instance->View->render();
    }
}

?>