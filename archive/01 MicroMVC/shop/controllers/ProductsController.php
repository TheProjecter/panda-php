<?php

class ProductsController extends Controller {
    
    protected $models = array('Product');
    
    public function view($id = null) {
        $product = $this->Product->read($id, null);
        
        $this->View->set('xhtml', new XHTMLHelper());
        $this->View->set('product', $product);
        $this->View->set('_pageTitle', $product->name);
    }
    
}

?>