<?php 

class Panda_Util {
	public static function extractArray(&$source, array $keys) {
        $out = array();
    
        foreach ($keys as &$key) {
            $out[$key] = $source[$key];
        }

        return $out;
    }
}

?>