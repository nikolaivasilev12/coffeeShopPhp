<?php 

class Admin extends Controller {
    
    public function getCategories() {
        return (self::query("SELECT * FROM category"));
    }
    public function getProducts() {
        return (self::query("SELECT * FROM product"));
    }
    public function updateCategory($name, $description, $categoryID) { 
        $name = trim($name);
        $description = trim($description);
        self::query("UPDATE category SET name = '{$name}', description = '{$description}' 
        WHERE categoryID = ('{$categoryID}')");
    }
    public function updateProductDetails($name, $description, $price, $stock, $origin, $type, $productID) {
        $name = trim($name);
        $description = trim($description);
        $price = trim($price);
        $stock = trim($stock);
        $origin = trim($origin);
        self::query("UPDATE product SET name = '{$name}', description = '{$description}',
        price = '{$price}', stock = '{$stock}', origin = '{$origin}', type = '{$type}', isSpecial = NULL
        WHERE productID = '{$productID}'");
    }
    public function updateProductIsSpecial ($productID, $isSpecial) {
        self::query("UPDATE product SET isSpecial = '{$isSpecial}'
        WHERE productID = '{$productID}'");
    }
    public function updateProductCategory($productID, $categoryID) {
        $productHasCategory = self::query("SELECT * FROM producthascategory
        WHERE productID = '{$productID}'");
        if($productHasCategory){
            self::query("UPDATE producthascategory SET productID = '{$productID}', categoryID = '{$categoryID}'
            WHERE productID = '{$productID}'");
        } else {
            self::query("INSERT INTO producthascategory (productID, categoryID)
            VALUES ('{$productID}', '{$categoryID}')");
        }
    }
    public function createCategory($name, $description){
        $name = trim($name);
        $description = trim($description);
        self::query("INSERT INTO category (name, description)
        VALUES ('{$name}', '{$description}')");
    }
    public function deleteCategory($categoryID) {
        self::query("DELETE FROM producthascategory WHERE categoryID = '{$categoryID}'");
        self::query("DELETE FROM category WHERE categoryID = '{$categoryID}'");
    }
}
