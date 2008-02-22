<?php

abstract class Panda_Configuration {

	public static $defaults = array(
		'Panda' => array(
			'Default' => array(
				'ControlName' => 'Static',
				'ActionName' => 'index'
			)
		)
	);
	
	private static $hasImported = false;
	
	private static function importProjectConfiguration() {
		self::$hasImported = true;
		$className  = Panda::PROJECT_NAME.'_Configuration';
		$projConfig = new $className();
		foreach ($projConfig->config as $namespace => $value) {
			self::write($namespace, $value);
		}
	}
	
	private static function &getNode($namespace) {
		// Import the Project Configuration if needed.
		if (self::$hasImported === false) {
			self::importProjectConfiguration();
		}
		
		// Start with the root node.
		$node =& self::$defaults;
		
		// Split apart the requested namespace into requested nodes
		if (!empty($namespace)) {
			$ns = explode('.', $namespace);
			for ($i = 0; $i < count($ns); $i++) {
				// Loop across the requested nodes until the last node is reached.
				if (gettype($node) == 'string') $node = null;
				$node =& $node[ $ns[$i] ];
			}
		}
		
		// Return a reference to the last node in the namespace
		return $node;
	}
	
	final public static function read($namespace = '') {
		return self::getNode($namespace);
	}
	
	final public static function write($namespace, $value = null) {
		// If the node doesn't exist, it will be created automagically.
		$node =& self::getNode($namespace);
		$node = $value;
	}
}

?>