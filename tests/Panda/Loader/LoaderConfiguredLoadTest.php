<?php

require_once 'PHPUnit/Framework.php';
require_once 'Loader.php';

class LoaderConfiguredLoadTest
extends PHPUnit_Framework_TestCase
{
    private $Loader;

    public function setup()
    {
        $this->Loader = new Loader;
    }

    public function testConfiguredLoad()
    {
        $this->assertFalse(class_exists('Test_Class', false));
        $this->assertFalse(class_exists('Test_Package_Foo', false));

        $this->Loader->configure(array(
            'baseDir' => dirname(__FILE__),
            'namespace' => 'Test',
            'load' => array('Class', 'Test_Package_Foo')
        ));

        $this->assertTrue(class_exists('Test_Class', false));
        $this->assertTrue(class_exists('Test_Package_Foo', false));
    }
}