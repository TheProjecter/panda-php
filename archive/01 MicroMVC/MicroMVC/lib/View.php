<?php

class View {
	
	private $Controller;
	private $variables = array();
	public  $helpers = array();
	public  $layout;
	public  $view;
	public  $extension;

	public function __construct($Controller) {
		$this->Controller = $Controller;
		$this->layout     = 'default';
		$this->view       = $this->Controller->getAction();
		$this->extension  = 'html';
	}
	
	private function getViewData() {
		return
			'views'.
			SEP.strtolower($this->Controller->getController()).
			SEP.$this->view.
			'.'.$this->extension;
	}
	
	private function getLayoutData() {
		return
			'layouts'.
			SEP.$this->layout.
			'.'.$this->extension;
	}
	
	public function set($name, $value) {
		$this->variables[$name] = $value;
	}
	
	public function render() {
		extract($this->variables, EXTR_SKIP);
		
		if(!isset($_pageTitle)) {
            $_pageTitle = $this->Controller->getController();
		}
		
		ob_start();
		include($this->getViewData());
		$_pageContent = ob_get_clean();
		
		include($this->getLayoutData());
	}
	
}

?>