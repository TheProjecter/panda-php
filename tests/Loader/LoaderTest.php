<?php 

require_once 'PHPUnit/Framework.php';
require_once 'Loader.php';

class LoaderTest
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
    public function setup () {
        $this->Loader = new Loader();
    }

    /**
     * Test the namespace get/set routines
     * @test
     */
    public function testNamespace()
    {
        $someNameSpace = 'Test';
        
        $this->Loader->setNamespace($someNameSpace);
        $this->assertEquals($someNameSpace, $this->Loader->getNamespace());
    }

    /**
     * Test the baseDir get/set routines
     * @test
     */
    public function testBaseDir()
    {
        $someBaseDir = '/path/to/some/dir';
        
        $this->Loader->setBaseDir($someBaseDir);
        $this->assertEquals($someBaseDir, $this->Loader->getBaseDir());
    }

    /**
     * A data provider for testClassName
     * @return array
     */
    public static function classNameProvider()
    {
        return array(
            // Try something simple
            array(
            	'Foo', 
            	'Bar', 
            	'Foo_Bar'
            ),
            
            // A fully packaged example -- underscores become directory separators
            array(
            	'Mikeg', 
            	'Blog_Profile', 
            	'Mikeg_Blog_Profile'
            ),
            
            // Classes already namespaced should not be re-namespaced
            array(
            	'Something', 
            	'Something_Else', 
            	'Something_Else'
            ),
            
            // The same applies for core libraries, they are already namespaced
            array(
            	'Penguin', 
            	'Panda_Loader_Interface', 
            	'Panda_Loader_Interface'
            )
        );
    }
    
    /**
     * Test class name calculation
     * @test
     * @dataProvider classNameProvider
     */
    public function testClassName($namespace, $className, $result)
    {
        $this->Loader->setNamespace($namespace);
        $this->assertEquals($result, $this->Loader->getClassName($className));
    }
    
	/**
     * A data provider for testFileName
     * @return array
     */
    public static function fileNameProvider()
    {
        return array(
            // Try something simple
            array(
                '/home/someUser/www',
            	'Foo', 
            	'Bar', 
            	'/home/someUser/www/Foo/Bar.php'
            ),
            
            // A fully packaged example -- underscores become directory separators
            array(
            	'/lib',
            	'Mikeg', 
            	'Blog_Profile', 
            	'/lib/Mikeg/Blog/Profile.php'
            ),
            
            // Classes already namespaced should not be re-namespaced
            array(
                't/e/s/t',
            	'Something', 
            	'Something_Else', 
            	't/e/s/t/Something/Else.php'
            ),
            
            // The same applies for core libraries
            array(
                '/animals',
            	'Penguin', 
            	'Panda_Loader_Interface', 
            	'/animals/Panda/Loader/Interface.php'
            )
        );
    }

    /**
     * Test file name calculation
     * @test
     * @dataProvider fileNameProvider
     */
    public function testFileName($baseDir, $namespace, $className, $result)
    {
        $this->Loader->setBaseDir($baseDir);
        $this->Loader->setNamespace($namespace);
        $this->assertEquals($result, $this->Loader->getFileName($className));
    }
}