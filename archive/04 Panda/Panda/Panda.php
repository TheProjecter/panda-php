<?php

define('PANDA_PANDA_DIR', dirname(__FILE__));
define('PANDA_ROOT_DIR',  dirname(PANDA_PANDA_DIR));
define('PANDA_WWW_DIR',   PANDA_PROJECT_DIR.DS.'WWW');

class Panda {

	// ** Why reiterate what's already defined?
	const ROOT_DIR     = PANDA_ROOT_DIR;
	const PANDA_DIR    = PANDA_PANDA_DIR;
	const PROJECT_NAME = PANDA_PROJECT_NAME;
	const PROJECT_DIR  = PANDA_PROJECT_DIR;
	const WWW_DIR      = PANDA_WWW_DIR;

	public static $Request;

	public static function bootstrap() {
		require self::PANDA_DIR.DS.'Functions.php';

		dev('Starting Panda::bootstrap');

		// Initialize the source loader
		dev('Loading the Panda_Loader');
		require self::PANDA_DIR.DS.'Loader.php';
		Panda_Loader::register('/(.*)/', self::ROOT_DIR);
		Panda_Loader::register('/(.*)/', self::PANDA_DIR);

		dev('Retrieving primary Request');
		self::$Request = new Panda_Request;
		dev('Processing Request');
		$output = self::$Request->process();
		dev('Outputing result from primary Request');
		dev(str_repeat('-', 80));
		echo $output;
		dev(str_repeat('-', 80));
		dev('Closing');
	}
}

?>