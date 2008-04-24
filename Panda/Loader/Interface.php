<?php

/**
 * An interface for source loaders
 * 
 * @package Panda_Loader
 * @author Michael Girouard (mikeg@lovemikeg.com)
 */
interface Panda_Loader_Interface
{
    /**
     * Returns the current namespace
     * 
     * @return string
     */
    public function getNamespace();
    
    /**
     * Sets the current
     * 
     * @param string $namespace
     */
    public function setNamespace($namespace);
    
    /**
     * Returns the base director
     * 
     * @return string
     */
    public function getBaseDir();
    
    /**
     * Sets the base directory
     * 
     * @param string $baseDir
     */
    public function setBaseDir($baseDir);
    
    /**
     * Returns a full class name
     * 
     * @param string $className
     * @return string
     */
    public function getClassName($className);
    
    /**
     * Returns a full path and file name
     * 
     * @param string $className
     * @return string
     */
    public function getFileName($className);
    
    /**
     * Loads a class
     */
    public function load($className);
    
    /**
     * Loads a class and returns an instance of it
     */
    public function loadInstance($className, array $parameters = array());
}