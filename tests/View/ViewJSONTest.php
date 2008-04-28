<?php

require 'Panda/View/JSON.php';


class ViewJSONTest
extends PHPUnit_FrameWork_TestCase
{

    private $View;
    
	public function setup()
	{
		$this->View = new Example_View_JSON;
	}
	
	public function testRender()
	{
	    $actual   = json_encode($this->View->getData());
		$rendered = $this->View->render();
		
		$this->assertEquals($rendered, $actual);
	}
}


class Example_View_JSON
extends Panda_View_JSON
{
	protected $data = array(
	    'one'   => 'two',
	    'three' => 'four',
	    'five'  => array('six' => 'seven')
	);
	protected $echoOutput = false;
}