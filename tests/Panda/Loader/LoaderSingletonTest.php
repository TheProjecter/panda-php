<?php

require 'Panda/Loader/Singleton.php';
require 'PHPUnit/FrameWork/TestCase.php';

class LoaderSingletonTest
extends PHPUnit_FrameWork_TestCase
{
	public function setup()
	{
		$this->Loader = Panda_Loader_Singleton::singleton();
		$this->Loader->setNamespace('Test');
		$this->Loader->setBaseDir(dirname(__FILE__));
	}
	
	public function testIsSingleton()
	{
	    $this->assertSame($this->Loader, Panda_Loader_Singleton::singleton());
	}
	
	public function testAutoload()
	{
	    spl_autoload_register(array('Panda_Loader_Singleton', 'autoload'));
	    
	    $this->assertTrue(class_exists('Test_Class', true));
	    $this->assertTure(class_exists('Test_Package_Foo', true));
	}
}