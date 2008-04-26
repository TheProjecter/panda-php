<?php 

require_once 'Panda/View/Abstract.php';

/**
 * A view for rendering JSON data
 * 
 * This is an unstructured view and doesn't offer any formatting capabilities.
 *
 * @package Panda_View
 * @author  Michael Girouard
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
class View_JSON
extends View_Abstract
{
    /**
     * Renders the JSON data
     *
     * @return string The encoded data
     */
    public function render()
    {
        echo json_encode($this->data);
    }
}