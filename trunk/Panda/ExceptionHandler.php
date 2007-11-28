<?php

// Set a fallback Error handler
set_error_handler(array('Panda_ExceptionHandler', 'errorHandler'));

// Set a fallback Exception handler
set_exception_handler(array('Panda_ExceptionHandler', 'exceptionHandler'));

/**
 * Panda_ExceptionHandler
 * 
 * @author Aaron 'Rabbit' van Kaam <rabbit@hydrastudio.com>
 * @version 1.0
**/
class Panda_ExceptionHandler {
	
	public static function errorHandler($errno, $errstr, $errfile, $errline)
	{
		throw new Panda_Exception_ErrorBased($errno, $errstr, $errfile, $errline);
	}
	
	public static function exceptionHandler(Exception $Exception)
	{
		die('ok');
        $msg = $Exception->__toString();
        if (empty($msg)) {
        	$msg = $Exception->getMessage();
        }
        if ($Exception instanceof Panda_Exception_ErrorBased) {
        	if ($Exception->getCode() == E_USER_ERROR) {
        		die($msg);
        	} else {
        		echo $msg;
        	}
        }
	}
	
}

?>