<?php 

require_once 'View/Abstract.php';

class View_XML
extends View_Abstract
{
    protected $document;
    protected $rootNode = 'data';
    protected $formatOutput = true;

    public function render()
    {
        $this->document = new DOMDocument;
        $this->document->formatOutput = $this->formatOutput;

        $root  = $this->document->createElement($this->rootNode);
        $this->getNodes($this->data, $root);

        $this->document->appendChild($root);
        echo $this->document->saveXML();
    }

    protected function getNodes($struct, DOMNode $parentNode)
    {
        if ($this->isIteratable($struct)) {
            foreach ($struct as $key => $value) {
                /* Numbers don't make good node names, use the parent's instead */
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

    protected function isIteratable($struct)
    {
        return is_object($struct) || is_array($struct) || $struct instanceof Iterator;
    }
}