<?php

class CategoryModel extends ActiveRecordModel {
    
    protected $table = 'categories';
    
    public function findProducts($category) {
        $sql = 
            "SELECT Product.id, Product.name ".
            "FROM products Product ".
            "LEFT JOIN categories_products CategoriesProducts ".
            "ON CategoriesProducts.product_id = Product.id ".
            "WHERE CategoriesProducts.category_id = '$category'";
            
        return $this->execute($sql);
    }
    
}

?>