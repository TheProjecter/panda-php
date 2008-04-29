<?php 

require 'Panda/View/PHP.php';

class ViewPHPTest
extends PHPUnit_FrameWork_TestCase
{
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
extends Panda_View_PHP
{

    protected $data = array(
        'hello' => 'world',
        'foo'   => array('bar')
    );
    
    protected $echoOutput = false;
}