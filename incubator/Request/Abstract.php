<?php

/**
 * A request handler
 *
 * @package Panda_Model
 * @author Michael Girouard (mikeg@lovemikeg.com)
 */
class Panda_Request
extends Panda_Model 
{
    /**
     * The request URI
     * 
     * @var string
     */
    protected $uri;
    
    /**
     * The request method
     * 
     * @var string
     */
    protected $method;
    
    /**
     * The constructor
     */
    public function __construct()
    {
        $this->uri    = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->data   = $_REQUEST;
    }
    
    /**
     * Returns the request method
     */
    public function getMethod()
    {
        return $this->method;
    }
    
    /**
     * Returns the request URI
     */
    public function getURI()
    {
        return $this->uri;
    }
}