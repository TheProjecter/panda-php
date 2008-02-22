<?php

/**
 * Shorter alias for DIRECTORY_SEPARATOR
 **/
define('SEP', DIRECTORY_SEPARATOR);

/**
 * Core Library Directory
 **/
define('MICROMVC_DIR', dirname(__FILE__));

/*
 * Reset the include path
 */
set_include_path(PROJECT_DIR.':'.MICROMVC_DIR.':'.get_include_path());

/*
 * Initialize the controller
 */
Controller::init();

/**
 * Class Autoloader
 * 
 * Intercepts a missing class error and attempts to discover and load it in. A 
 * call is made to the load method to ultimately include the resource. 
 * Underscores in class names are resolved to directory separators to allow for 
 * PEAR-style "package" support.
 *
 * @param string $className
 * @return void
 * @author Michael Girouard
 **/
function __autoLoad($className) {
	if(preg_match('/.+Controller$/', $className)) {
		$directory = 'controllers';
	}
	elseif(preg_match('/.+Model$/', $className)) {
		$directory = 'models';
	}
	elseif(preg_match('/.+Helper$/', $className)) {
		$directory = 'helpers';
	}
	else {
		$directory = 'lib';
	}
	
	/*
	 * Break the className into separate parts at the underscore and then 
	 * reassemble it back together using the directory separator.
	 */
	$className = implode(SEP, explode('_', $className));
	
	load($className, $directory);
}

/**
 * Resource Loader
 * 
 * Attempts to load a resource. The Project Directory will always be favored
 * over the Core Library Directory in the event that the developer wants to
 * override some core functionality with their own.
 *
 * @param string $className
 * @param string $directory
 * @return void
 * @author Michael Girouard
 **/
function load($className, $directory, $extension = 'php') {
	$classPath = PROJECT_DIR . SEP . $directory . SEP . $className . ".$extension";
	
	if(!file_exists($classPath)) {
		$classPath = MICROMVC_DIR . SEP . $directory . SEP . $className . ".$extension";
	}
	
	require $classPath;
}

?>