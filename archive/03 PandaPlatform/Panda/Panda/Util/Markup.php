<?php 

class Panda_Util_Markup {
	public static function wrap($content, $tag, $attributes=array()) {
	    $attributes = self::generateAttributes($attributes);
        
        if (is_array($content) || is_object($content)) {
            $out = '';
            
            foreach ($content as $value) {
                $out .= sprintf('<%s%s>%s</%s>', $tag, $attributes, $value, $tag);
            }
            
            return $out;
        }
        else {
            return sprintf('<%s%s>%s</%s>', $tag, $attributes, $value, $tag);
        }
    }
    
    public static function generateAttributes($attributes) {
        $out = '';
        $attributes = (array)$attributes;
        
        foreach ($attributes as $key => $value) {
            $out .= sprintf(' %s="%s"', $key, $value);
        }
        
        return $out;
    }
    
    public static function markdown($content) {}
}

?>