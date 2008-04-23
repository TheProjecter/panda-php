<?php 

require_once 'View/Abstract.php';

class View_JSON
extends View_Abstract
{
    public function render()
    {
        echo json_encode($this->data);
    }
}