<?php

/**
 * A path interface
 * 
 * Provides a simple interface to build and manipulate paths.
 *
 * @package Panda_Path
 * @author Michael Girouard
 **/
interface Panda_Path_Interface
{
    /**
     * Returns a string representation of the path
     *
     * @return string
     * @author Michael Girouard
     **/
    public function __toString();
    
    /**
     * Returns a path component
     *
     * @return string
     * @author Michael Girouard
     **/
    public function getComponent($componentLocation);
    
    /**
     * Returns a range of path components
     *
     * @return array
     * @author Michael Girouard
     **/
    public function getComponentRange($componentLocation, $length);
    
    /**
     * Adds a path component at a given location
     *
     * @author Michael Girouard
     **/
    public function addComponent($component, $componentLocation);
    
    /**
     * Replaces an existing path component with a new one
     *
     * @author Michael Girouard
     **/
    public function replaceComponent($component, $componentLocation);
    
    /**
     * Removes an existing path component entirely
     *
     * @author Michael Girouard
     **/
    public function removeComponent($componentLocation);
}