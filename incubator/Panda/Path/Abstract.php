<?php

abstract class Panda_Path_Abstract
implements Panda_Path_Interface
{

    protected $components = array();
    
    protected $delimiter;

    public function __toString()
    {
        return implode($this->delimiter, $this->components);
    }
    
    public function getComponent($componentLocation)
    {
        if (array_key_exists($componentLocation, $this->components)) {
            return $this->components[$componentLocation];
        }
        else {
            return null;
        }
    }

    public function getComponentRange($componentLocation, $length)
    {
        if (array_key_exists($componentLocation, $this->components) &&
            array_key_exists($componentLocation + ($length - 1), $this->components)) {
            
            return array_slice($this->components, $componentLocation, $length);
        }
        else {
            return null;
        }
    }
    
    public function addComponent($component, $componentLocation = null)
    {
        if ($componentLocation === null ||
            !array_key_exists($componentLocation, $this->components)) {
                
            $this->components[] = $component;
        }
        else {
            $tail = array_splice($this->components, $componentLocation);
            $this->components[] = $component;
            $this->components = array_merge($this->components, $tail);
        }
    }
    
    public function replaceComponent($component, $componentLocation)
    {
        if (array_key_exists($componentLocation, $this->components)) {
            $this->components[ $componentLocation ] = $component;
        }
        else {
            $this->addComponent($component, $componentLocation);
        }
    }
    
    public function removeComponent($componentLocation)
    {
        unset($this->components[ $componentLocation ]);
        $this->components = array_splice($this->components, 0);
    }
}