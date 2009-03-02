<?php

/**
 * Represents an RSS2 Feed
 *
 * @package Panda_Feed
 * @author Michael Girouard (mikeg@lovemikeg.com)
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
class Panda_Feed_RSS2
extends Panda_Feed_Abstract
{
    public function prepareFeedXML()
    {}
    
    public static function validate(DOMDocument $feedXML)
    {}
}