<?php

/**
 * An abstract controller
 */
abstract class Panda_Controller_Abstract
implements Panda_Controller_Interface 
{
    public function getView()
    {}
    
    public function setView()
    {}
    
    abstract public function dispatch();
}