<?php

/**
 * Represents a feed item
 *
 * @package Panda_Feed
 * @author Michael Girouard (mikeg@lovemikeg.com)
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
class Panda_Feed_Item
implements Panda_Feed_Item_Interface
{
    /**
     * Returns a formatted XML string for a feed item
     *
     * @return string
     */
    public function __toString()
    {
        return '';
    }
}