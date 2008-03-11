<?php

require_once 'PHPUnit/Framework.php';
require_once 'Loader.php';

class LoaderLoadInstanceTest
extends PHPUnit_Framework_TestCase 
{
    /**
     * The loader instance
     *
     * @var Panda_Loader
     */
    private $Loader;
    
    /**
     * The setup method
     */
    public function setUp()
    {
        $this->Loader = new Loader;
        $this->Loader->setBaseDir( dirname(__FILE__) );
    }

	/**
     * Data provider for loadnIstanceTest 
     */
    public static function loadProvider()
    {
        return array(
            array('Test', 'Class'),
            array('Test', 'Package_Foo'),
            array('AnotherTest', 'Bar', array('a', 'b', 'c'))
        );
    }
    
	/**
     * Tests loading classes and creating instances
     * @test
     * @dataProvider loadProvider
     */
    public function loadInstanceTest($nameSpace, $className, $arguments = array())
    {
        $this->Loader->setNamespace($nameSpace);
        $fullClassName = $this->Loader->getClassName($className);
        
        // The class *should not* exist yet...
        $this->assertFalse(class_exists($fullClassName, false));
        
        // Now it should... and so should an instance 
        $instance = $this->Loader->loadInstance($className, $arguments);
        $this->assertTrue( $instance instanceof $fullClassName );
        
        // If arguments were passed, test those too
        if (count($arguments) === 3) {
            $this->assertTrue($instance->doTest(
                $arguments[0],
                $arguments[1],
                $arguments[2]
            ));
        }
    }
}