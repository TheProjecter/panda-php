<?php

/**
 * A request handler
 *
 * @package Panda_Request
 * @author Michael Girouard (mikeg@lovemikeg.com)
 */
class Panda_Request_Abstract
implements Panda_Request_Interface
{
    /**
     * The request URI
     * 
     * @var string
     */
    private $uri;
    
    /**
     * The request method
     * 
     * @var string
     */
    private $method;
    
    /**
     * The request data
     *
     * @var array
     */
    private $data = array();
    
    /**
     * The constructor
     */
    protected function __construct()
    {
        $this->uri    = $_SERVER['REQUEST_URI'];
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->data   = $_REQUEST;
    }
    
    /**
     * Finalized cloner
     *
     */
    final private function __clone() 
    {}
    
    /**
     * Returns the request URI
     */
    public function getURI()
    {
        return $this->uri;
    }
    
    /**
     * Returns the request method
     */
    public function getMethod()
    {
        return $this->method;
    }
    
    /**
     * Returns the request data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}