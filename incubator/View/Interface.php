<?php 

/**
 * An interface for views
 *
 * @package Panda_View
 * @author  Michael Girouard (mikeg@lovemikeg.com)
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
interface Panda_View_Interface
{
    /**
     * Gets a view variable
     *
     * @param string $name
     */
    public function getVar($name);
    
    /**
     * Sets a view variable
     *
     * @param string $name
     * @param mixed $value
     */
    public function setVar($name, $value);
    
    /**
     * Unsets a view variable
     *
     * @param string $name
     */
    public function unsetVar($name);
    
    /**
     * Renders the view
     *
     */
    public function render();
}