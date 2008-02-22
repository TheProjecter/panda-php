<?php

class Panda_Configuration 
{
    private $values = array(
        'defaultController' => 'static',
        'defaultAction'     => 'index'
        );
    
    public function __get($key) 
    {
        if (array_key_exists($key, $this->values)) {
            return $this->values[$key];
        }
        else {
            return null;
        }
    }
    
    public function __set($key, $value) 
    {
        $this->values[$key] = $value;
    }
}

?>