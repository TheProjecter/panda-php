<?php

class Panda_ShadowRequest {

	public $control;

	public function __construct($controlName) {
		$className = Panda::PROJECT_NAME.'_'.$controlName.'Control';
		$this->control = new $className;
	}

	public function __call($method, $params) {
		return call_user_func(array(&$this->control, $method), $params);
	}
}

class Panda_Request {

	private static $raw;

	private $controlName;
	private $actionName;


	private function getRuntime($namespace) {
		return Panda_Configuration::read("Panda.Runtime.Request.{$namespace}");
	}

	private function setRuntime($namespace, $value = null) {
		Panda_Configuration::write("Panda.Runtime.Request.{$namespace}", $value);
	}

	public function __get($controlName) {
		return new Panda_ShadowRequest($controlName);
	}

	public static function uriToPhp($str) {
		$conversion = strtolower( str_replace('_', '-', $str) );
		$conversion = explode('-', $conversion);
		$firstWord  = array_shift($conversion);
		foreach ($conversion as $k => &$word) {
			$word = ucfirst($word);
		}
		return $firstWord.implode('', $conversion);
	}

	public function process() {
		if ($this->getRuntime('hasHandledPrimary') !== true) {
			$this->setRuntime('hasHandledPrimary', true);
			dev('Primary request. Parse the URI ...');

			self::parseURI();
			if (isset(self::$raw[0])) {
				$this->controlName = ucfirst(self::uriToPhp(self::$raw[0]));
			} else {
				$this->controlName = Panda_Configuration::read('Panda.Default.ControlName');
			}
			dev('Determined the Control name to be: '.$this->controlName);

			if (isset(self::$raw[1])) {
				$this->actionName = self::uriToPhp(self::$raw[1]);
			} else {
				$this->actionName = Panda_Configuration::read('Panda.Default.ActionName');
			}
			dev('Determined the Control Action name to be: '.$this->actionName);

			$className = Panda::PROJECT_NAME.'_'.$this->controlName.'Control';
			$PrimaryControl = new $className;
			return $PrimaryControl->{$this->actionName}();
		}
	}

	public static function parseURI() {
		self::$raw = preg_replace('/\/\/+/', '/', $_SERVER['QUERY_STRING']);
	    self::$raw = preg_replace('/^\//', '', self::$raw);
	    self::$raw = (empty(self::$raw))? array() : explode('/', self::$raw);
	}

    public static function getParams()
    {
        if (!array_key_exists('params', self::$uri)) {
            $componentCount = count(self::$uri['raw']);
            self::$uri['params'] = array();

            if ($componentCount > 2) {
                for ($i = 2; $i < $componentCount; $i++) {
                    self::$uri['params'][] = self::$uri['raw'][$i];
                }
            }
            else {
                self::$uri['params'] = null;
            }
        }

        return self::$uri['params'];
    }

	/*
    private static $uri = array();

    public static function parseURI()
    {
        self::getURI();
        self::getControllerName();
        self::getActionName();
        self::getParams();
    }

    public static function getURI($asPath = false)
    {
        if (!array_key_exists('raw', self::$uri)) {
            $raw = preg_replace('/\/\/+/', '/', $_SERVER['QUERY_STRING']);
            $raw = preg_replace('/[^a-zA-Z0-9\-_\.\/]/', '', $raw);
            $raw = preg_replace('/^\//', '', $raw);

            self::$uri['raw'] = explode('/', $raw);
            if (count(self::$uri['raw']) == 1 && trim(self::$uri['raw'][0]) == '') {
            	unset(self::$uri['raw'][0]);
            }
        }

        if ($asPath) {
            return implode('/', self::$uri['raw']);
        }
        else {
            return self::$uri['raw'];
        }
    }

    public static function getControllerName()
    {
    	if (!array_key_exists('controller', self::$uri)) {
    		if (count(self::$uri['raw']) > 0) {
    			self::$uri['controller'] = self::$uri['raw'][0];
    		} else {
    			self::$uri['controller'] = Panda::getInstance('Panda_Configuration')->defaultController;
    		}
    	}
    	return self::$uri['controller'];
    }

    public function getControllerClassName() {
    	return PROJECT_NAME . '_Controller_' . ucfirst( self::getControllerName() );
    }



    public static function getActionName()
    {
        if (!array_key_exists('action', self::$uri)) {
            if (count(self::$uri['raw']) > 1) {
                self::$uri['action'] = self::$uri['raw'][1];
            }
            else {
                self::$uri['action'] = null;
            }
        }

        if (!empty(self::$uri['action'])) {
            return self::$uri['action'];
        }
        else {
            return Panda::getInstance('Panda_Configuration')->defaultAction;
        }
    }

    public static function getParams()
    {
        if (!array_key_exists('params', self::$uri)) {
            $componentCount = count(self::$uri['raw']);
            self::$uri['params'] = array();

            if ($componentCount > 2) {
                for ($i = 2; $i < $componentCount; $i++) {
                    self::$uri['params'][] = self::$uri['raw'][$i];
                }
            }
            else {
                self::$uri['params'] = null;
            }
        }

        return self::$uri['params'];
    }
    */
}

?>