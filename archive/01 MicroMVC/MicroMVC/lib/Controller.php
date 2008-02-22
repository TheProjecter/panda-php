<?php

abstract class Controller {
	
	private static $Instance;
	protected $View;
	private static $path = array();
	private static $controller;
	protected static $action;
	protected static $params = array();
	protected $models = array();
	
	// Magic {{{
	
	protected function __construct() {
		$this->loadModels();
		$this->loadView();
		$this->startUp();
	}
	
	public function __destruct() {
		$this->shutDown();
		$this->View->render();
	}
	
	// }}}
	
	// Startup {{{
	
	public static function init() {
		if(is_null(self::$Instance)) {
			self::setPath();
			self::setController();
			self::setAction();
			self::setParams();

			$controllerName = ucfirst(self::$controller).'Controller';
			self::$Instance = new $controllerName();
			
			/* Call the method corresponding to the requested action */
			call_user_func_array(
				array(
					self::$Instance, /* Target the concrete Controller, */
					self::$action    /* call this method, */
				), 
				self::$params        /* and pass these parameters. */
			);
		}
	}
	
	private static function setPath() {
		$path = str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['REQUEST_URI']);
		$path = preg_replace('/\/+\//', '/', $path);
		$path = preg_replace('/[^a-z0-9\/~]/i', '', $path);
			
		if($path == dirname($_SERVER['SCRIPT_NAME']).'/') {
			$path = '';
		}
		
		$parts = explode('/', $path);
		
		foreach($parts as $part) {
			if(!empty($part)) {
				self::$path[] = $part;
			}
		}
	}
	
	private static function setController() {
		if(isset(self::$path[0])) {
			self::$controller = self::$path[0];
		}
		else {
			self::$controller = Config::DEFAULT_CONTROLLER;
		}
	}
	
	private static function setAction() {
		if(isset(self::$path[1])) {
			self::$action = self::$path[1];
		}
		else {
			self::$action = Config::DEFAULT_ACTION;
		}
	}
	
	private static function setParams() {
		$partCount = count(self::$path);
		
		if($partCount > 2) {
			for($i = 2; $i < $partCount; $i++) {
				self::$params[] = self::$path[$i];
			}
		}
	}
	
	private function loadModels() {
		foreach($this->models as $model) {
			$className = $model.'Model';
			$this->$model = new $className($this);
		}
	}
	
	private function loadView() {
		$this->View = new View($this);
	}
	
	// }}}
	
	// Accessors {{{
	
	public function getAction() {
		return self::$action;
	}
	
	public function getController() {
		return self::$controller;
	}
	
	// }}}
	
	// Support {{{
	
	public function requireParamCount($paramCount) {
		if(count(self::$params) < $paramCount) {
            throw new Exception('Not enough params');
		}
	}
	
	protected function startUp() {}
	
	protected function shutDown() {}

    // }}}
}

?>