<?php

/**
 * A controller for REST based applications
 *
 * @package Panda_Controller
 * @author Michael Girouard (mikeg@lovemikeg.com)
 */
abstract class Panda_Controller_REST_Abstract
extends Panda_Controller_Abstract 
{
    /**
     * The request
     * 
     * @var Panda_Request
     */
    protected $Request;
    
    /**
     * Constructor
     * 
     * @param Panda_Request $Request
     */
    public function __construct(Panda_Request $Request)
    {
        $this->Request = $Request;
    }
    
    /**
     * Dispatches the controller's action
     */
    public function dispatch()
    {
        $method = $this->Request->getMethod();
        
        if (method_exists($this, $method)) {
            $this->{$method}();
        }
        else {
            throw new Exception('Undefined request method handler for ' . $method);
        }
    }
}