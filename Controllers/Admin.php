<?php 

class Admin extends Controller {

    public function createCategory($name, $description){
        $name = trim($name);
        $description = trim($description);
        self::query("INSERT INTO category (name, description)
        VALUES ('{$name}', '{$description}')");
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
    public function updateNews($content){
         self::query("UPDATE news SET content = '{$content}' WHERE ID = 1");
    }

        /* Edit company's Desc, address, phone no., email */
    public function updateCompDesc($companyDescription){
        $companyDescription = trim($companyDescription);
        self::query("UPDATE companydata SET companyDescription = '{$companyDescription}'");
    }
    public function updateCompAddress($companyAddress){
        $companyAddress = trim($companyAddress);
        self::query("UPDATE companydata SET adress = '{$companyAddress}'");
    }
    public function updateCompPhone($companyPhone){
        $companyPhone = trim($companyPhone);
        self::query("UPDATE companydata SET phone = '{$companyPhone}'");
    }
    public function updateCompEmail($companyEmail){
        $companyEmail = trim($companyEmail);
        self::query("UPDATE companydata SET email = '{$companyEmail}'");
    }

    /* Updating Working Hours */
    public function updateHours($startingHours, $closingHours, $ID){
        $startingHours = trim($startingHours);
        $closingHours = trim($closingHours);
    self::query("UPDATE workdays SET startingHour = '{$startingHours}',
    closingHour = '{$closingHours}' WHERE ID = ('{$ID}')");
    }

    public function deleteCategory($categoryID) {
        self::query("DELETE FROM producthascategory WHERE categoryID = '{$categoryID}'");
        self::query("DELETE FROM category WHERE categoryID = '{$categoryID}'");
    }
    public function deleteProduct($productID) {
        $productHasCategory = self::query("SELECT * FROM producthascategory
        WHERE productID = '{$productID}'");
        $productHasOrder = self::query("SELECT * FROM orderhasproduct
        WHERE productID = '{$productID}'");
        $productHasRating = self::query("SELECT * FROM rating
        WHERE productID = '{$productID}'");
        if($productHasCategory){
            self::query("DELETE FROM producthascategory WHERE productID = '{$productID}'");
        } 
        if ($productHasOrder) {
            self::query("DELETE FROM orderhasproduct WHERE productID = '{$productID}'");
        } 
        if ($productHasRating) {
            self::query("DELETE FROM rating WHERE productID = '{$productID}'");
        } 
        self::query("DELETE FROM product WHERE productID = '{$productID}'");
    }
}
