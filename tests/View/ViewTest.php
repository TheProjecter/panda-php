<?php

require 'Panda/View/Abstract.php';

/**
 * Tests for core view operations
 *
 */
class ViewTest
extends PHPUnit_FrameWork_TestCase
{
    /**
     * The view instance
     *
     * @var unknown_type
     */
    protected $View;
    
    /**
     * Creates the view instance
     *
     */
    public function setup()
    {
        $this->View = new Example_View;
    }
    
    /**
     * Tests the getters and setters for view vars
     *
     */
    public function testVars()
    {
        $data = array(
            'name'   => 'Mike',
            'gender' => 'male',
            'eyes'   => 'blue'
        );
        
        $dataCount = count($data);
        
        // Make sure setVar and getVar work
        foreach ($data as $key => $value) {
            $this->View->setVar($key, $value);
            $this->assertEquals($value, $this->View->getVar($key));
        }
        
        $this->View->setData(array());
        
        // getVar should return null now that none of these values exist anymore
        foreach ($data as $key => $value) {
            $this->assertNull($this->View->getVar($key));
        }
        
        // One last check to make sure
        $this->View->setData($data);
        $this->assertEquals($data, $this->View->getData());
    }
    
    /**
     * Tests verbose output
     *
     */
    public function testEchoOutput()
    {
        $data = array('foo' => 'bar');
        $printedData = print_r($data, true);
        
        $this->View->setEchoOutput(true);
        $this->View->setData($data);
        
        ob_start();
        $this->View->render();
        $echoedOutput = ob_get_contents();
        ob_end_clean();
        
        $this->assertEquals($printedData, $echoedOutput);
    }
    
    /**
     * Tests silent output
     *
     */
    public function testSilentOutput()
    {
        $data = array('baz' => 'bif');
        $printedData = print_r($data, true);
        
        $this->View->setEchoOutput(false);
        $this->View->setData($data);
        
        $returnedOutput = $this->View->render();
        
        $this->assertEquals($printedData, $returnedOutput);
    }
}

/**
 * Example view
 *
 */
class Example_View
extends Panda_View_Abstract
{
    /**
     * Simply print_r's the data
     *
     * @return unknown
     */
    public function render()
    {
        return $this->output(print_r($this->data, true));
    }
}