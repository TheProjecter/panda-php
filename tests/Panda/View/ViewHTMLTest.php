<?php

require 'Panda/View/HTML.php';

class ViewHTMLTest
extends PHPUnit_FrameWork_TestCase
{
    private $View;
    
	public function setup()
	{
		$this->View = new Example_View_HTML;
	}
	
	public function testLoadTemplate()
	{
	    $rendered = $this->View->render();
	    $document = new DOMDocument;
	    $document->loadHTML($rendered);
	    
	    $title = $document->getElementsByTagName('title')->item(0);
	    
	    $this->assertNotEquals('', $rendered);
	    $this->assertNotNull($title);
	    $this->assertEquals('A Admin Template Example', $title->nodeValue);
	    
	    $this->View->setTemplate('templates/default.html');
	    $rendered = $this->View->render();
	    $document->loadHTML($rendered);
	    
	    $title = $document->getElementsByTagName('title')->item(0);
	    
	    $this->assertNotEquals('', $rendered);
	    $this->assertNotNull($title);
	    $this->assertEquals('A Default Template Example', $title->nodeValue);
	}
	
    public function testLoadPartial()
	{
	    $rendered = $this->View->render();
	    $document = new DOMDocument;
	    $document->loadHTML($rendered);
	    
	    $p = $document->getElementsByTagName('p')->item(0);
	    
	    $this->assertNotNull($p);
	    $this->assertEquals('Hello, world.', $p->nodeValue);
	}
	
    public function testParse()
	{
	    $this->View->setPartial('partials/index.html', '/html/body');
	    $rendered = $this->View->render();
	    
	    $document = new DOMDocument;
	    $document->loadHTML($rendered);
	    
	    $h1 = $document->getElementsByTagName('h1')->item(0);
	    $tr = $document->getElementsByTagName('tr');
	    
	    $this->assertNotNull($h1);
	    $this->assertNotNull($tr->item(0));
	    $this->assertEquals($tr->length, count($this->View->getData()));
	}
}

class Example_View_HTML
extends Panda_View_HTML 
{
	protected $data = array('foo' => 'bar');
	protected $echoOutput = false;
	protected $template = 'templates/admin.html';
	protected $partials = array(
		'partials/hello.html' => '/html/body'
    );
}