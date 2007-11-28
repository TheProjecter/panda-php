<?php

/**
 * String Helpers
 *
 * @package String
 * @author Michael Girouard
 **/
class Panda_String
{
    /**
     * Prints a formatted array
     * 
     * Prints a formatted array according to $format. See self::asprintf() for
     * a list of supported meta characters.
     *
     * @return int The length of the resulting string
     * @author Michael Girouard
     * @see self::asprintf()
     **/
    public static function aprintf($format, array $values, $inbetween = '') 
    {
        echo $formatted = self::asprintf($format, $values, $inbetween);
        return strlen($formatted);
    }
    
    /**
     * Returns a formatted array
     * 
     * Returns a formatted array, as a string, according to $format. Supported 
     * meta-characters are %k and %v for array keys and values respectively.
     *
     * @return void
     * @author Michael Girouard
     **/
    public static function asprintf($format, array $values, $inbetween = '')
    {
        $out = array();
        
        foreach ($values as $key => $value) {
            $out[] = str_replace(
                array('%k', '%v'),
                array($key, $value),
                $format
            );
        }
        
        return implode($inbetween, $out);
    }
}

?>