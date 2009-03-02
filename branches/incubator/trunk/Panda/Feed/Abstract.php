<?php

/**
 * Abstract Feed Base Class 
 *
 * @package Panda_Feed
 * @author Michael Girouard (mikeg@lovemikeg.com)
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
class Panda_Feed_Abstract
implements Panda_Feed_Interface
{
    /**
     * The XML Feed
     *
     * @var DOMDocument
     */
    private $feedXML;
    
    /**
     * Sets the $feedXML property and prepares the document
     *
     * @param DOMDocument $feedXML
     */
    public function __construct(DOMDocument $feedXML)
    {
        $this->feedXML = $feedXML;
        $this->prepareFeedXML();
    }
    
    /**
     * Returns a formatted XML string of the feed
     *
     * @return unknown
     */
    public function __toString()
    {
        return $this->fedXML->saveXML();
    }
    
    /**
     * Called by __construct; prepares the feed for consumption
     *
     */
    abstract public function preparFeedXML();
}