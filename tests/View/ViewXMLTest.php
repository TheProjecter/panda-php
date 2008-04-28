<?php

require 'Panda/View/XML.php';

class ViewXMLTest
extends PHPUnit_FrameWork_TestCase
{
	public function setup()
	{
		$this->View = new Panda_View_XML;
		$this->View->setEchoOutput(false);
		
		$this->View->setRootNodeName('test');
		$this->View->setData(array(
		    'ingredients' => array('dirt', 'water'),
		    'instructions' => array(
		        'Add water to dirt.',
		        'Play in mud.'
		    )
		));
	}
	
	public function testRootNode() 
	{
	    $document = new DOMDocument;
	    $rendered = $this->View->render();
	    $document->loadXML($rendered);
	    
	    $this->assertEquals($document->documentElement->nodeName, 'test');
	    
	    $this->View->setRootNodeName('testData');
	    $rendered = $this->View->render();
	    $document->loadXML($rendered);
	    
	    $this->assertEquals($document->documentElement->nodeName, 'testData');
	}
	
	public function testFormatOutput() 
	{
	    $this->View->setFormatOutput(false);
	    $rendered = trim($this->View->render());
	    
	    $count = count(explode("\n", $rendered));
	    $count -= 1; // Don't count the XML declaration 
	    
	    $this->assertEquals(1, $count);
	    
	    $this->View->setFormatOutput(true);
	    $rendered = trim($this->View->render());
	    
	    $count = count(explode("\n", $rendered));
	    $count -= 1; // Don't count the XML declaration
	    
	    $this->assertGreaterThan(1, $count);
	}
	
	public function testRenderedData()
	{
	    $this->View->setFormatOutput(false);
        $data     = $this->View->getData();
	    $document = new DOMDocument;
        $rendered = $this->View->render();
        $document->loadXML($rendered);
        
        $this->assertEquals(count($data), $document->documentElement->childNodes->length);
        
        $this->assertEquals(
            count($data['ingredients']),
            $document->documentElement->childNodes->item(0)->childNodes->length
        );
        
        $this->assertEquals(
            count($data['instructions']),
            $document->documentElement->childNodes->item(1)->childNodes->length
        );
	}
}