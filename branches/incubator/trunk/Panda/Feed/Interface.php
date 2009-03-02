<?php

/**
 * An interface for any kind of feed
 *
 * @package Panda_Feed
 * @author Michael Girouard (mikeg@lovemikeg.com)
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
interface Panda_Feed_Interface
{
    public static function validate(DOMDocument $feedXML);
    
    public function __construct(DOMDocument $feedXML);
    
    public function __toString();
}