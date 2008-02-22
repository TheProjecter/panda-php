<?php

class CategoriesController extends Controller {
    
    protected $models = array('Category');
    
    public function index() {
        $this->View->set('categories', $this->Category->find('id,name', array(
                'parent_id' => '0',
                'active'    => '1'
            )));
        
        $this->View->set('_pageTitle', 'Category List');
    }
    
    public function view($id = null) {
        $category = $this->Category->find(null, array('id' => $id));
        $categories = $this->Category->find('id,name', array('parent_id' => $id));
        $products = $this->Category->findProducts($id);
        
        $this->View->set('category', $category[0]);
        $this->View->set('categories', $categories);
        $this->View->set('products', $products);
        $this->View->set('_pageTitle', $category[0]->name);
    }
    
}

?>