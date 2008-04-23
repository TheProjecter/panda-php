<?php 

require_once 'View/Interface.php';

abstract class View_Abstract
implements View_Interface
{
    protected $data       = array();
    protected $echoOutput = true;

    public function getVar($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        else {
            return null;
        }
    }

    public function setVar($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function unsetVar($name)
    {
        if (array_key_exists($name, $this->data)) {
            unset($this->data[$name]);
        }
    }
    
    public function getData()
    {
        return $this->data;
    }
    
    public function setData(array $data)
    {
        $this->data = $data;
    }
    
    public function setEchoOutput($bool)
    {
        $this->echoOutput = (bool)$bool;
    }
    
    public function output($output)
    {
        if ($this->echoOutput) {
            echo $output;
        }
        
        return $output;
    }
}