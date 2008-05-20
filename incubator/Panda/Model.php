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
     * This should be pre-poulated at the class level for each model 
     * specifically. If this is left empty, anything may be set to the model.
     * 
     * @var array
     */
    protected $properties = array();
    
    /**
     * The model's data
     * 
     * @var array
     */
    protected $data = array();
    
    /**
     * The getter
     * 
     * @param string $name
     * @return mixed
     */
    public function getValue($name)
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
    public function setValue($name, $value)
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
    {
        return $this->properties;
    }
    
    /**
     * Returns the data in the model
     * 
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
    
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