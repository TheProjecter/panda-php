<?php

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
}