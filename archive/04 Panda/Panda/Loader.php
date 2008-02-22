<?php

// ** Class loading is far too complex
// ** PEAR's is short and sweet 
abstract class Panda_Loader {
	
	public static $routes = array(); // TODO: Make this private
	
	final public static function register($expression, $resolve) {
		self::$routes[] = array($expression, $resolve);
	}
	
	final public static function load($className) {
		dev('    Panda_Loader::load('.$className.')');
		foreach (self::$routes as $entry) {
			list($expression, $resolve) = $entry;
			if (preg_match($expression, $className)) {
				if (is_array($resolve)) {
					pr($resolve);
					die('Alternative Conversion Behaviours Not Yet Supported');
				} else {
					$file = $resolve .DS. self::defaultConversionBehavior($className);
					dev('    Opening '.$file);
					if (is_file($file)) {
						require $file;
						return;
					}
				}
			}
		}
		dev('    Failed!');
	}
	
	final public static function defaultConversionBehavior($className) {
		$mutation = explode('_', $className);
		$last =& $mutation[ count($mutation) - 1 ];
		
		if ($last != 'Control' && $last != 'Model') {
			// Determine if the last portion is a Project Control or Project Model
			$control = preg_replace('/Control$/', '', $last);
			if ($control != $last) {
				// A match was found. This is a control.
				$last = 'Control'.DS.$control;
			} else {
				$model = preg_replace('/Model$/', '', $last);
				if ($model != $last) {
					// A match was found. This is a model.
					$last = 'Model'.DS.$model;
				}
			}
		}
		return implode(DS, $mutation).'.php';
	}
}

spl_autoload_register(array('Panda_Loader', 'load'));

?>