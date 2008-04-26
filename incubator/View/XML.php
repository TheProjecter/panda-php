<?php 

require_once 'Panda/View/Abstract.php';

/**
 * A view for rendering basic XML data
 * 
 * This is an unstructured view and doesn't offer any formatting capabilities.
 *
 * @package Panda_View
 * @author  Michael Girouard
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
class View_XML
extends View_Abstract
{
    /**
     * The XML document
     *
     * @var DOMDocument
     */
    protected $document;
    
    /**
     * The name to use for the root node
     *
     * @var string
     */
    protected $rootNode = 'data';
    
    /**
     * Whether or not to format the XML at render time
     *
     * @var boolean
     */
    protected $formatOutput = true;

    /**
     * Renders the XML data
     *
     * @return string The XML data
     */
    public function render()
    {
        $this->document = new DOMDocument;
        $this->document->formatOutput = $this->formatOutput;

        $root  = $this->document->createElement($this->rootNode);
        $this->getNodes($this->data, $root);

        $this->document->appendChild($root);
        return $this->output($this->document->saveXML());
    }

    /**
     * Gets XML nodes from arbitrary data structures
     * 
     * Appends XML nodes to the provided parentNode by recursivly transforming
     * the view's data into XML. 
     *
     * @param mixed $struct An arbitrary data structure
     * @param DOMNode $parentNode A DOMNode to append the XML to
     */
    protected function getNodes($struct, DOMNode $parentNode)
    {
        if ($this->isIteratable($struct)) {
            foreach ($struct as $key => $value) {
                /* Numbers don't make good node names, use the parent's */
                if (is_numeric($key)) {
                    $key = $parentNode->nodeName;
                }

                $childNode = $this->document->createElement($key);
                $this->getNodes($value, $childNode);
                $parentNode->appendChild($childNode);
            }
        }
        else {
            $nodeValue = $this->document->createTextNode((string)$struct);
            $parentNode->appendChild($nodeValue);
        }
    }

    /**
     * Tests if a data structure is iteratable
     *
     * @param  mixed $struct The value to test
     * @return boolean True if the object is iteratable; false otherwise 
     */
    protected function isIteratable($struct)
    {
        return is_object($struct) || is_array($struct) || $struct instanceof Iterator;
    }
}