<?php 

require 'setup.php';
require 'View/PHP.php';

class ViewPHPTest
extends PHPUnit_FrameWork_TestCase
{
    /**
     * Tests the rendering of serialized PHP
     *
     * @test
     **/
    public function testRender()
    {
        $view = new Example_View_PHP;
        $this->assertEquals($view->render(), serialize(array(
            'hello' => 'world',
            'foo'   => array('bar')
        )));
    }
}

class Example_View_PHP
extends View_PHP
{
    protected $data = array(
        'hello' => 'world',
        'foo'   => array('bar')
    );
    
    protected $echoOutput = false;
}