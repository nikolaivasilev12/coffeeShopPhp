<?php 

class Admin extends Controller {

    public function createCategory($name, $description){
        $name = trim($name);
        $description = trim($description);
        $params = array($name, $description);
        self::query("INSERT INTO category (name, description)
        VALUES ( ? , ? )", $params);
    }
    public function getCategories() {
        return (self::query("SELECT * FROM category"));
    }
    public function getProducts() {
        return (self::query("SELECT * FROM product"));
    }


    /* Getting Company's DATA FIRST */
    public function getCompDesc() {
        return (self::query("SELECT companyDescription FROM companydata"));
    }
    public function getCompAddress() {
        return (self::query("SELECT adress FROM companydata"));
    }
    public function getCompPhone() {
        return (self::query("SELECT phone FROM companydata"));
    }
    public function getCompEmail() {
        return (self::query("SELECT email FROM companydata"));
    }

    public function updateCategory($name, $description, $categoryID) { 
        $name = trim($name);
        $description = trim($description);
        $params = array($name, $description, $categoryID);
        self::query("UPDATE category SET name = ? , description = ? 
        WHERE categoryID = ? ", $params);
    }
    public function updateProductDetails($name, $description, $price, $stock, $origin, $type, $productID) {
        $name = trim($name);
        $description = trim($description);
        $price = trim($price);
        $stock = trim($stock);
        $origin = trim($origin);
        $params = array($name, $description, $price, $stock, $origin, $type, $productID);
        self::query("UPDATE product SET name = ? , description = ? ,
        price = ?, stock = ?, origin = ? , type = ? , isSpecial = NULL
        WHERE productID = ? ", $params);
    }
    public function updateProductIsSpecial ($productID, $isSpecial) {
        $params = array($isSpecial, $productID);
        self::query("UPDATE product SET isSpecial = ?
        WHERE productID = ? ", $params);
    }
    public function updateProductCategory($productID, $categoryID) {
        $productHasCategory = self::query("SELECT * FROM producthascategory
        WHERE productID = '{$productID}'");
        if($productHasCategory){
            $params = array($productID, $categoryID, $productID);
            self::query("UPDATE producthascategory SET productID = ? , categoryID = ?
            WHERE productID = ? ", $params);
        } else {
            $paramsElse = array($productID, $categoryID);
            self::query("INSERT INTO producthascategory (productID, categoryID)
            VALUES ( ? , ? )", $paramsElse);
        }
    }
    public function updateNews($content){
        $params = array($content);
        self::query("UPDATE news SET content = ? WHERE ID = 1", $params);
    }

    /* Edit company's Desc, address, phone no., email */
        public function updateCompanyData($content){
            $params = array($content['companyDescription'], $content['adress'], $content['phone'], $content['email']);
            self::query("UPDATE companydata SET companyDescription = ? , adress = ? , phone = ? ,
            email = ? WHERE ID = 1", $params);
        }

    /* Updating Working Hours */
    public function updateHours($startingHours, $closingHours, $ID){
        $startingHours = trim($startingHours);
        $closingHours = trim($closingHours);
        $params = array($startingHours, $closingHours, $ID);
        self::query("UPDATE workdays SET startingHour = ? ,
        closingHour = ? WHERE ID = ? ", $params);
    }

    public function deleteCategory($categoryID) {
        $params = array($categoryID);
        self::query("DELETE FROM producthascategory WHERE categoryID = ? ", $params);
        self::query("DELETE FROM category WHERE categoryID = ? ", $params);
    }
    public function deleteProduct($productID) {
        $params = array($productID);
        $productHasCategory = self::query("SELECT * FROM producthascategory
        WHERE productID = ? ", $params);
        $productHasOrder = self::query("SELECT * FROM orderhasproduct
        WHERE productID = ? ", $params);
        $productHasRating = self::query("SELECT * FROM rating
        WHERE productID = ? ", $params);
        if($productHasCategory){
            self::query("DELETE FROM producthascategory WHERE productID = ? ", $params);
        } 
        if ($productHasOrder) {
            self::query("DELETE FROM orderhasproduct WHERE productID = ? ", $params);
        } 
        if ($productHasRating) {
            self::query("DELETE FROM rating WHERE productID = ? ", $params);
        } 
        self::query("DELETE FROM product WHERE productID = ? ", $params);
    }
}
