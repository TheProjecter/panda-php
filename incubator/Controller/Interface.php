<?php

/**
 * The controller interface
 * 
 * @package Panda_Controller
 * @author Michael Girouard (mikeg@lovemikeg.com)
 */
interface Panda_Controller_Interface
{
    /**
     * Returns the view instance
     */
    public function getView();
    
    /**
     * Sets the view instance
     */
    public function setView(Panda_View $View);
    
    /**
     * Dispatches a controller's action
     */
    public function dispatch();
}