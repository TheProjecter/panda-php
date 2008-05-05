<?php

require 'Panda/Loader/Abstract.php';

/**
 * A singleton source loader
 *
 * @package Panda_Loader
 * @author  Michael Girouard
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
class Panda_Loader_Singleton
extends Panda_Loader_Abstract
{
    /**
     * Returns a singleton instance
     *
     * @return Panda_Loader_Singleton
     */
	public static function singleton()
	{
		static $Instance;
		
		if ($Instance === null) {
			$Instance = new self;
		}
		
		return $Instance;
	}
	
	/**
	 * An autoloader which for use with SPL
	 *
	 * @param string $className
	 * @return bool
	 */
	public static function autoload($className)
	{
	    return self::singleton()->load($className);
	}

	/**
	 * Prevents unwanted cloning
	 */
	private function __clone() 
	{}
}