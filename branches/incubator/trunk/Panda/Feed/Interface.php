<?php

interface Panda_Feed_Interface
{
    public static function validate(DOMDocument $feedXML);
    
    public function __construct(DOMDocument $feedXML);
    
    public function __toString();
}