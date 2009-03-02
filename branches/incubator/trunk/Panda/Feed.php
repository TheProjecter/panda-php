<?php

/**
 * A feed factory and manager library
 *
 * @package Panda_Feed
 * @author Michael Girouard (mikeg@lovemikeg.com)
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
class Panda_Feed
{
    private static $feedTypes = array('Panda_Feed_Atom', 'Panda_Feed_RSS2');
    
    public static function factory(DOMDocument $feedXML)
    {
        foreach (self::$feedTypes as $className) {
            $feedIsValid = call_user_func(array($className, 'validate'), $feedXML);
            
            if ($feedIsValid) {
                return new $className($feedXML);
            }
            
            return null;
        }
    }

    public static function enableFeedType($feedType)
    {
        if (!in_array($feedType, self::$feedTypes)) {
            self::$feedTypes[] = $feedType;
        }
    }
    
    public static function disableFeedType($feedType)
    {
        $feedTypeCount = count(self::$feedTypes);
        
        for ($i = 0; $i < $feedTypeCount; $i++) {
            if (self::$feedTypes[$i] === $feedType) {
                unset(self::$feedTypes[$i]);
            }
        }
    }
}