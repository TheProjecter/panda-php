<?php

class Panda_Feed_Abstract
implements Panda_Feed_Interface
{
    /**
     * The XML Feed
     *
     * @var DOMDocument
     */
    private $feedXML;
    
    public function __construct(DOMDocument $feedXML)
    {
        $this->feedXML = $feedXML;
        $this->prepareFeedXML();
    }
    
    public function __toString()
    {
        return $this->fedXML->saveXML();
    }
    
    abstract public function prepareeedXML();
}