<?php

/**
 * A generic object for storing data
 * 
 * By default field names are validated against the $fields property. This can 
 * be turned off by setting the $validateFields property to false in a concrete
 * class.
 *
 * @package ValueObject
 * @author Michael Girouard
 **/
abstract class Panda_ValueObject
implements Iterator
{
    /**
     * Flag to validate fields
     *
     * @var boolean
     **/
    protected $validateFields = true;
    
    /**
     * The field whitelist
     * 
     * This is only enforced while self::$validateFields is set to true.
     *
     * @var array
     **/
    protected $fields = array();
    
    /**
     * The record values
     *
     * @var string
     **/
    protected $values = array();

    /**
     * The constructor
     *
     * @author Michael Girouard
     **/
    public function __construct($data) 
    {
        if (is_array($data) || is_object($data)) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * The magic setter
     * 
     * Captures any time a property is attempted to be set. If the property 
     * name is a valid field (defined by self::$fields) it will be set (in
     * self::values).
     *
     * @author Michael Girouard
     **/
    public function __set($name, $value)
    {
        if ($this->validateFields && !in_array($name, $this->fields)) {
            return;
        }

        $this->values[$name] = $value;
    }
    
    /**
     * The magic getter
     *
     * Captures any request to record data. Returns the corresponding value or 
     * 
     * @return mixed
     * @author Michael Girouard
     **/
    public function __get($name)
    {
        if (array_key_exists($name, $this->values)) {
            return $this->values[$name];
        }
        else {
            return null;
        }
    }
    
    /**
     * Satasfies Iterator interface requirement
     */
    public function current() {
        return current($this->values);
    }
    
    /**
     * Satasfies Iterator interface requirement
     */
    public function next() {
        return next($this->values);
    }
    
    /**
     * Satasfies Iterator interface requirement
     */
    public function key() {
        return key($this->values);
    }
    
    /**
     * Satasfies Iterator interface requirement
     */
    public function rewind() {
        return reset($this->values);
    }
    
    /**
     * Satasfies Iterator interface requirement
     */
    public function valid() {
        return (current($this->values) !== false);
    }
}

?>