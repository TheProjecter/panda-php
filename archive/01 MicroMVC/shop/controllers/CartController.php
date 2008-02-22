<?php

class CartController extends Controller {
    
    protected $models = array('Product');
    private $contents = array();
    
    protected function startup() {
        session_start();
        session_regenerate_id();
        
        if(!array_key_exists('CartContents', $_SESSION)) {
            $_SESSION['CartContents'] = array();
        }
        
        $this->contents &= $_SESSION['CartContents'];
    }
    
    public function index() {
        $products = array();
        
        foreach($_SESSION['CartContents'] as $product) {
            $products[] = $this->Product->read($product[0]);
        }
        
        $this->View->set('products', $products);
        $this->View->set('_pageTitle', 'Cart Contents');
    }
    
    public function clear() {
        $_SESSION['CartContents'] = array();
        
        header('Location: ?/cart');
        exit;
    }
    
    public function add($id = null, $quantity = 1) {
        print_r($this->contents);
        if(!empty($id)) {
            $_SESSION['CartContents'][] = array($id, $quantity);
            // array_push($this->contents, array($id, $quantity));
        }
        
        header('Location: ?/cart');
        exit;
    }
    
}

?>