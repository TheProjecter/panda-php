<?php 

require_once 'View/Abstract.php';

class View_HTML
extends View_Abstract
{
    protected $document;
    protected $template;
    protected $partials;
    
    public function parse($file)
    {
        $out = '';
        
        if (is_file($file)) {
            ob_start();
            
            include $file;
            $out = ob_get_contents();
            
            ob_end_clean();
        }

        return $out;
    }

    public function load($source, $target)
    {
        $xpath = new DOMXPath($this->document);
        $items = $xpath->query($target);

        if ($items->length > 0) {
            $source   = $this->parse($source);
            $fragment = $this->document->createDocumentFragment();
            
            $fragment->appendXML($source);
            $items->item(0)->appendChild($fragment);
        }
    }

    public function render()
    {
        if (empty($this->template) || !is_array($this->partials)) {
            throw new Exception('Unable to render: incomplete view configuration.');
        }
        
        $templateContents = $this->parse($this->template);
        
        if (!empty($templateContents)) {
            $this->document = new DOMDocument;
            $this->document->loadHTML($templateContents);
            
            foreach ($this->partials as $source => $target) {
                $this->load($source, $target);
            }

            echo $this->document->saveHTML();
        }
    }
}