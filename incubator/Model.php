<?php

/**
 * A generic model to represent any kind of data
 *
 * @package Panda_Model
 * @author Michael Girouard (mikeg@lovemikeg.com)
 */
class Panda_Model
{
    /**
     * A list of the model's allowed properties
     * 
     * @var array
     */
    protected $properties;
    
    /**
     * The model's data
     * 
     * @var array
     */
    protected $data;
    
    /**
     * The getter
     * 
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (in_array($name, $this->data)) {
            return $this->data[$name];
        }
        else {
            return null;
        }
    }
    
    /**
     * The setter
     * 
     * Only valid properties are allowed to be set. If the properties array is 
     * empty, anything may be set.
     * 
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if (in_array($name, $this->properties) || empty($this->properties)) {
            $this->data[$name] = $value;
        }
    }
    
    /**
     * Returns the list of allowed properties
     * 
     * @return array
     */
    public function getProperties()
    {}
    
    /**
     * Returns the data in the model
     * 
     * @return array
     */
    public function getData()
    {}
    
    /**
     * Sets data in the model from array values
     */
    public function setData(array $data)
    {
        foreach ($data as $key => $value) {
            $this->__set($key, $value);
        }
    }
}