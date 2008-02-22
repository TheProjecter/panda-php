<?php

/**
 * The ActiveRecord Interface
 *
 * @package ActiveRecord
 * @author Michael Girouard
 **/
interface Panda_ActiveRecord_Interface
{
    /**
     * Saves a record
     *
     * @return boolean
     * @author Michael Girouard
     **/
    public function save();
    
    /**
     * Locates a set of records
     *
     * @return array
     * @author Michael Girouard
     **/
    public function find($fields = array(), $modifiers = array());
    
    /**
     * Removes a record
     *
     * @return boolean
     * @author Michael Girouard
     **/
    public function remove();
}

?>