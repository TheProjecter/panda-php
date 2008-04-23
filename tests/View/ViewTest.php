<?php 

require 'setup.php';
require 'View/PHP.php';

class ViewTest
extends PHPUnit_FrameWork_TestCase
{
    protected $View;
    
    public function setup()
    {
        $this->View = new View;
    }
    
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

class View
extends View_Abstract
{
    public function render()
    {
        return $this->output(print_r($this->data, true));
    }
}