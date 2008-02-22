<?php

/**
 * A Data Filter
 * 
 * A simple and elegant input filter and output escaping mechanism that takes
 * advantage of PHP 5's __get and __set interceptors
 *
 * @package default
 * @author Michael Girouard
 * @see http://www.lovemikeg.com/blog/2007/10/30/feio-with-php-5-interceptors/
 **/
class Panda_DataFilter 
{
    protected $data = array();
    
    public function __construct(array $data, array $contexts) 
    {
        $this->data = $data;

        foreach ($contexts as $contextName => $context) {
            $this->{$contextName} = new $context($this->data);
        }
    }
}

?>