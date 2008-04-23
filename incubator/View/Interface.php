<?php 

interface View_Interface
{
    public function getVar($name);
    public function setVar($name, $value);
    public function unsetVar($name);
    public function render();
}