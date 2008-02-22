<?php

class Helper {
    
    public function getElement($tag, $attributes = null, $content = null, $forceClose = false) {
        if(!empty($content) || $forceClose) {
            return sprintf(
                    '<%s%s>%s</%s>', 
                    $tag, 
                    $this->getAttributes($attributes),
                    $content,
                    $tag
                );
        }
    }
    
    public function getAttributes($attributes) {
        $attributes = (array)$attributes;
    }
    
}

?>