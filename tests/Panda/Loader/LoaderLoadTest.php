<?php

require_once 'PHPUnit/Framework.php';
require_once 'Loader.php';

class LoaderLoadTest
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
     * Data provider for loadTest 
     */
    public static function loadProvider()
    {
        return array(
            array('Test', 'Class'),
            array('Test', 'Package_Foo')
        );
    }
    
    /**
     * Tests loading classes
     * @test
     * @dataProvider loadProvider
     */
    public function loadTest($nameSpace, $className)
    {
        $this->Loader->setNamespace($nameSpace);
        $fullClassName = $this->Loader->getClassName($className);
        
        // The class *should not* exist yet...
        $this->assertFalse(class_exists($fullClassName, false));
        
        // Now it should...
        $this->Loader->load($className);
        $this->assertTrue(class_exists($fullClassName, false));
    }
}