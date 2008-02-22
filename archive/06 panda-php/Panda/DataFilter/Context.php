<?php

abstract class Panda_DataFilter_Context 
{
    protected $data = array();

    public function __construct(array $data) 
    {
        $this->data = $data;
    }

    abstract public function __get($name);
    abstract public function __set($name, $value);
}

?>