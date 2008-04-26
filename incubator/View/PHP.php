<?php 

require_once 'Panda/View/Abstract.php';

/**
 * A view for rendering serialized PHP
 * 
 * This is an unstructured view and doesn't offer any formatting capabilities.
 *
 * @package Panda_View
 * @author  Michael Girouard
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
class Panda_View_PHP
extends Panda_View_Abstract
{
    /**
     * Renders the serialized data
     *
     * @return string The Rendered data
     */
    public function render()
    {
        return $this->output(serialize($this->data));
    }
}