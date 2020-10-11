<?php 

class Admin extends Controller {
    
    public function getCategories() {
        $categoriesArr = (self::query("SELECT * FROM category"));
        return $categoriesArr;
    }
    public function getProducts() {
        $productsArr = (self::query("SELECT * FROM product"));
        return $productsArr;
    }
    public function updateCategory($name, $description, $categoryID) { 
        $name = trim($name);
        $description = trim($description);
        self::query("UPDATE category SET name = '{$name}', description = '{$description}' 
        WHERE categoryID = ('{$categoryID}')");
    }
    public function createCategory($name, $description){
        self::query("INSERT INTO category (name, description)
        VALUES ('{$name}', '{$description}')");
    }
    public function deleteCategory($categoryID) {
        self::query("DELETE FROM producthascategory WHERE categoryID = '{$categoryID}'");
        self::query("DELETE FROM category WHERE categoryID = '{$categoryID}'");
    }
}

?>