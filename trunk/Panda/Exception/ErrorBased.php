<?php

/**
 * Panda_Exception_ErrorBased is intended to replace most PHP
 * errors by packing the error data into equivalent properties.
 * @see Panda::errorHandler()
**/
class Panda_Exception_ErrorBased extends Panda_Exception
{
	public function __construct($errno, $errstr, $errfile, $errline) {
		switch ($errno) {
		case E_NOTICE:
		case E_USER_NOTICE:
		case E_WARNING:
		case E_USER_WARNING:
		case E_USER_ERROR:
			break;
		default:
			$errno = E_USER_ERROR;
			break;
		}
		parent::__construct($errstr, $errno);
		$this->file = $errfile;
		$this->line = $errline;
	}
	
	/**
	 * Mimics the default PHP error 
	**/
	public function __toString() {
		switch ($this->code) {
		case E_NOTICE:
		case E_USER_NOTICE:
			$prefix = 'Notice: ';
			break;
		case E_WARNING:
		case E_USER_WARNING:
			$prefix = 'Warning: ';
			break;
		default:
			$prefix = 'Error: ';
			break;
		}
		
		return (
			"<strong>{$prefix}</strong> "
			. $this->getMessage()
			. " in <strong>{$this->file}</strong>"
			. " on line <strong>{$this->line}</strong>"
		);
	}
}
