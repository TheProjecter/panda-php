<?php 

require_once 'View/Abstract.php';

class View_PHP
extends View_Abstract
{
    public function render()
    {
        return $this->output(serialize($this->data));
    }
}