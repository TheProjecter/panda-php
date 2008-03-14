<?php

/**
 * A routable controller
 *
 */
abstract class Panda_Controller_Routable_Abstract
implements Panda_Controller_Interface 
{
    /**
     * The route
     * 
     * @var Panda_Route
     */
    protected $Route;
    
    /**
     * The request
     * 
     * @var Panda_Request
     */
    protected $Request;
    
    /**
     * Constructor
     */
    public function __construct(Panda_Route $Route, Panda_Request $Request)
    {
        $this->Route = $Route;
        $this->Request = $Request;
    }

    /**
     * Dispatches the controller's action
     */
    public function dispatch()
    {
        if (method_exists($this, $this->Route->action)) {
            $this->{$this->Route->action}();
        }
        else {
            throw new Exception('Undefined action handler for ' . $this->Route->action);
        }
    }
}