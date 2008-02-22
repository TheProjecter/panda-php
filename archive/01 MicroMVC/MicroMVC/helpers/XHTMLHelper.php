<?php

class XHTMLHelper extends Helper {
    
    /**
     * Call Interceptor
     * 
     * Ran whenever a nonexistent method is called. The name of the method will
     * represent an XHTML element to create and the params will be the 
     * attributes to be set. 
     *
     * @return void
     * @author Michael Girouard
     **/
    public function __call($method, $params) {}
    
    public function formatText($content) {
        $out = '';
        
        if(!empty($content)) {
            $out = '<p>'.nl2br($content).'</p>';
        }
        
        return $out;
    }
    
    public function img($uri, $alt = '', $attributes = array()) {}
    
}

?>