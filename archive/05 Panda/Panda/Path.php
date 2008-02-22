<?php

/**
 * A Generic Path Object
 * 
 * A generic class to create a well formed path.
 *
 * @package default
 * @author Michael Girouard
 **/
class Panda_Path
{
    private $atRoot = false;
    private $parts = array();

    public function __construct($parts = array(), $atRoot = false) 
    {
        $this->parts = $parts;
        $this->atRoot = $atRoot;
    }

    public function __toString()
    {
        $out = ($this->atRoot) ? '/' : '';
        $out .= implode('/', $this->parts);

        return self::sanitize($out);
    }

    public static function sanitize($path) {
        $path = preg_replace('/\/\/*/', '/', $path);
        $path = preg_replace('/[^a-zA-Z0-9\-_\.\/]/', '', $path);
        $path = preg_replace('/(^\/|\/$)/', '', $path);
        return $path;
    }
}

?>