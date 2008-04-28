<?php 

require_once 'Panda/View/Abstract.php';

/**
 * A view for rendering HTML documents
 * 
 * This view offers a structured approach for rendering HTML documents for the 
 * web by defining two primary data types: templates and partials.
 * 
 * Templates are documents designed to contain partials. This will be your 
 * usually static content such as the header, navigation and footer of a web 
 * page. 
 * 
 * Partials are documents which live inside of templates. Partials may be 
 * placed anywhere within a template by specifying a target XPath. The first 
 * match will be used to inject the partial document.
 *
 * @package Panda_View
 * @author  Michael Girouard
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
class Panda_View_HTML
extends Panda_View_Abstract
{
    /**
     * The XML document
     *
     * @var DOMDocument
     */
    protected $document;
    
    /**
     * The path to the template being used
     *
     * @var string
     */
    protected $template;
    
    /**
     * An array of partial documents
     *
     * @var array
     */
    protected $partials;
    
    /**
     * Returns a file which has been parsed by PHP
     *
     * @param string $file The path and file name of the file to parse
     * @return string The parsed file
     */
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

    /**
     * Loads a partial into the template
     *
     * @param string $source The path and file name to the partial
     * @param string $target The target XPath to place the partial in
     */
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

    /**
     * Renders the HTML document
     *
     */
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

            return $this->output($this->document->saveHTML());
        }
    }
}