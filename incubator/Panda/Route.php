<?php

/**
 * A model for routes
 * 
 * This class extracts route data from the request URI without requiring the
 * use of a query string. Routes begin after the .php in the file name and 
 * before the ? in the query string. 
 *
 * @package Panda_Route
 * @author Michael Girouard (mikeg@lovemikeg.com)
 */
class Panda_Route
extends Panda_Model 
{
    /**
     * Allow a controller, action, and parameters
     */
    protected $properties = array('controller', 'action', 'params');
    
    /**
     * Route defaults
     * 
     * @var array
     */
    protected $data = array(
        'controller' => 'static',
        'action'     => 'index', 
        'params'     => array(),
        'output'	 => 'html'
    );

    /**
     * Default routes
     * 
     * Actual routes are the keys, mapped routes are the values. 
     * Example: '/catalog/search' => '/search'
     * 
     * @var array
     */
    protected $defaults = array();
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $route = $this->getRouteFromURI();
        
        if (in_array($route, $this->map)) {
            $route = $this->map[$route];
        }
    }
    
    /**
     * Object to string converter
     * 
     * @return string
     */
    public function __toString()
    {
        $command = sprintf(
            '/%s/%s',
            $this->data['controller'],
            $this->data['action']
        );
        
        if (count($this->data['params']) > 0) {
            $params = '/' . implode('/', $this->data['params']);
        }
        else {
            $params = '';
        }
        
        return $command . $params;
    }
    
    /**
     * Extracts the route from the URI
     * 
     * @return string
     */
    public function getRouteFromURI()
    {
        // Subtract the directory componet from the request URI
        $path = str_replace(dirname($_SERVER['SCRIPT_NAME']), '', $_SERVER['REQUEST_URI']);
        
        // Sometimes the file name remains. Remove it just in case
        $path = str_replace('/' . basename($_SERVER['SCRIPT_NAME']), '', $path);
        
        // The query string is not needed at this point either
        return str_replace($_SERVER['QUERY_STRING'], '', $path);
    }
}