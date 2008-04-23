<?php 

class Panda_Path_Directory
extends Panda_Path_Abstract
{
    protected $delimiter = '/';
    
    public static function sanitize($path) {
        /* Remove duplicate slashes */
        $path = preg_replace('/\/\/*/', '/', $path);
        
        /* Remove invalid characters */
        $path = preg_replace('/[^a-zA-Z0-9\-_\.\/]/', '', $path);
        
        /* Remove slashes at beginning and end */
        $path = preg_replace('/(^\/|\/$)/', '', $path);
        
        return $path;
    }
}