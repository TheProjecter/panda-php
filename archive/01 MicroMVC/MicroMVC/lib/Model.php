<?php

abstract class Model {
	
	const VALIDATE_REQUIRED = '/.+/';
	const VALIDATE_NUMERIC = '/[0-9]/';
	
	protected $Controller;
	protected $models = array();
	protected $fields = array();
	public $data = array();
	protected $rules = array();
	protected $errors = array();
	
	public function __construct($Controller) {
		$this->Controller = $Controller;
		$this->loadModels();
	}
	
	protected function stripExtraFields() {
		$out = array();
		
		foreach($this->data as $key => $value) {
			if(in_array($key, $this->fields)) {
				$out[$key] = $value;
			}
		}
	}
	
	protected function validate() {
		foreach($this->data as $key => $value) {
			if(array_key_exists($key, $this->rules)) {
				if(!preg_match($this->rules[$key][0], $this->data[$key])) {
					$this->errors[$key] = $this->rules[$key][1];
				}
			}
		}
	}
	
	private function loadModels() {
		foreach($this->models as $model) {
			$className = $model.'Model';
			$this->$model = new $className($this->Controller);
		}
	}
	
}

?>