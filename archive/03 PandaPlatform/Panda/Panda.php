<?php 

define('PANDA_DIR', dirname(__FILE__));
spl_autoload_register(array('Panda', 'load'));

class Panda
{
	public static function load($className)
	{
        $path = PANDA_DIR . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, explode('_', $className)) . '.php';
        
        if (is_file($path)) {
            require $path;
            return true;
        }
        else {
            return false;
        }
	}
}

?>