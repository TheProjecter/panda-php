<?php

/**
 * A wrapper for uploaded files
 * 
 * @package Panda_Request
 * @author Mike Girouard (mikeg@lovemikeg.com)
 */
class Panda_Request_File
{
    public $name;
    public $tmp_name;
    public $type;
    public $size;
    public $error;
    
    public function __construct(array $file)
    {
        $this->name     = $file['name'];
        $this->tmp_name = $file['tmp_name'];
        $this->type     = $file['type'];
        $this->size     = $file['size'];
        $this->error    = $file['error'];
    }
    
    public function moveTo($destination)
    {
        $dir = dirname($destination);
        
        if (is_dir($dir) && is_writable($dir)) {
            return move_uploaded_file($this->tmp_name, $destination);
        }
        else {
            return false;
        }
    }
}