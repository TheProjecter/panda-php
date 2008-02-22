<?php 

class Panda_Framework_Model extends Panda_Collection 
{
    protected $fields = array();
    
    public function __construct($data = null)
    {
    	$data = (object)$data;
    	
    	foreach ($data as $key => $value) {
    		$this->{$key} = $value;
    	}
    }
    
    public function __set($name, $value) 
    {
        if (in_array($name, $this->fields)) {
            parent::__set($name, $value);
        }
    }
    
    public function castData($data)
    {
    	
    	foreach ($this->fields as $field) {
    		if (!isset($data->{$field})) {
    			$data->{$field} = null;
    		}
    	}
    	
    	return $data;
    }
}

?>