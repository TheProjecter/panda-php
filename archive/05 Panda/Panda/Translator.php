<?php

/**
 * The Translator
 * 
 * @author Michael Girouard
 * @package Translator
 */
class Panda_Translator
{
    public static $localPath = '';
    public static $contextExtension = '.ini';

    protected $phrases = array();

    public function __construct($context) {
	$this->loadPhrases(
            self::$localPath . 
	    DIRECTORY_SEPARATOR .
            $context .
	    self::$contextExtension
	);
    }

    public function __get($name) {
	if (array_key_exists($name, $this->phrases)) {
	    return $this->phrases[$name]; 
	}
	else {
	    return null;
	}
    }

    public function loadPhrases($path) {
	$this->phrases = parse_ini_file($path);
    }
}

?>
