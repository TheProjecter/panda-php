<?php

class Panda_Util_Collection {
    
    private $collectionItems = array();
    
    public function __get($key) {
        if (array_key_exists($key, $this->collectionItems)) {
            return $this->collectionItems[$key];
        }
        else {
            return null;
        }
    }
    
    public function __set($key, $value) {
        $this->collectionItems[$key] = $value;
    }
    
}

?>