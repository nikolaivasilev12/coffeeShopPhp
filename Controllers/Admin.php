<?php

class Admin extends Controller {

    /* Create a new 'Category' */
    public function createCategory($name, $description){
        /* Sanitize Cat DATA */
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $params = array($name, $description);
        self::query("INSERT INTO category (name, description)
        VALUES ( ? , ? )", $params);
    }

    /* Create a new 'Product' */
    public function createProduct($name, $description, $price, $stock, $origin, $type, $isSpecial, $category){
        /* Sanitize create product admin fields */
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $price = filter_var($price, FILTER_SANITIZE_STRING);
        $stock = filter_var($stock, FILTER_SANITIZE_STRING);
        $origin = filter_var($origin, FILTER_SANITIZE_STRING);
        $type = filter_var($type, FILTER_SANITIZE_STRING);
        $isSpecial = filter_var($isSpecial, FILTER_SANITIZE_STRING);
        $params = array($name, $description, $price, $stock, $origin, $type, $isSpecial);
        self::query("INSERT INTO product (name, description, price, stock, origin, type, isSpecial)
        VALUES ( ? , ? , ? , ? , ? , ? , ? )", $params);

        /* Getting most recent productID */
        $productID = $this->array_flatten(self::query("SELECT productID FROM `product` ORDER BY productID DESC LIMIT 1"));

        /* Binding productID and CategoryID in the producthascategory table */
         self::query("INSERT INTO `producthascategory` (productID, categoryID) VALUES ( ? , ?)", array($productID['productID'], $category));
    }

    public function uploadProductImage($uploadFile) {
        if (isset($uploadFile)){
            if (isset($uploadFile['file'])){
                $file = $uploadFile['file'];
                $fileName = $uploadFile['file']['name'];
                $fileTmpName = $uploadFile['file']['tmp_name'];
                $fileSize = $uploadFile['file']['size'];
                $fileError = $uploadFile['file']['error'];
                $fileType = $uploadFile['file']['type'];
                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        if ($fileSize < 1000000) {
                            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                            $fileDestination = 'uploads/' . $fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDestination);
                            /*  If we dont have a productID passed down we will get the last inserted product's productID, 
                            assuming that the desired action will be to add an image to a newly created product */
                            if(empty($uploadfile['productID'])){
                                $productID = $this->array_flatten(self::query("SELECT productID FROM `product` ORDER BY productID DESC LIMIT 1"));
                                $params = array($fileNameNew, $productID['productID']);
                            } 
                            /*  If we have a productID passed down we will use it in the image table since the desired action in this
                            scenario would be that we want to add an image to an existing product   */
                            else if(!empty($uploadfile['productID'])) {
                                $productID = $uploadFile['productID'];
                                $params = array($fileNameNew, $productID);
                            }
                            self::query("INSERT INTO `image` (`name`, productID) VALUES ( ? , ? )", $params);

                        } else {
                            echo "Your file is too big!";
                        }
                    } else {
                        echo "There was an error uploading your file!";
                    }
                } else {
                    echo "You cannot upload files of this type!";
                }
            }
        }
    }




    public function getCategories() {
        return (self::query("SELECT * FROM category"));
    }
    public function getProducts() {
        $products = (self::query("SELECT * FROM product"));
         /* Check if each product contains an image and if it does add an image to the product's inner array */
        foreach ($products as $key => $product) {
        $productImage = $this->array_flatten(self::query("SELECT `name` FROM `image` WHERE productID = ? ", array($product['productID'])));
        if (!empty($productImage['name'])){
            $products[$key]['image'] = $productImage['name'];
        }
        }
        return $products;
    }
    public function getOrders() {
        return (self::query("SELECT * FROM `order`"));
    }
    public function getOrderTotal ($orderID) {
        return self::query("SELECT amount, price from orderhasproduct WHERE orderID = ? ", array($orderID));
    }
    public function getOrderById($orderId) {
        return (self::query("SELECT * FROM `order` WHERE orderID = ? ", array($orderId)));
    }
    public function getOrderAdress($adressId) {
        $adress = self::query("SELECT * FROM `adress` WHERE adressID = ? ", array($adressId));
        if(!empty($adress[0]['postalCode'])){
            $city = self::query("SELECT * FROM `postalcode` WHERE postalCode = ? ", array($adress[0]['postalCode']));
            return array($this->array_flatten($adress), $this->array_flatten($city));
        } else {
            return;
        }
    }
    public function getCustomerById($customerID) {
        return self::query("SELECT fname, lname, email, phoneNr FROM `customer` WHERE customerID = ? ", array($customerID));
    }
    public function getProductsByOrderId ($orderID) {
        $products = array();
        $productID = (self::query("SELECT productID from orderhasproduct WHERE orderID = ? ", array($orderID)));
        foreach ($productID as $product) {
            $productDetails = $this->array_flatten(self::query("SELECT * FROM `product`WHERE productID = ? ", array($product['productID'])));
            array_push($products, $productDetails);
        }
        return $products;
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
        /* Sanitizing UpdateCat fields */
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $params = array($name, $description, $categoryID);
        self::query("UPDATE category SET name = ? , description = ?
        WHERE categoryID = ? ", $params);
    }
    public function updateProductDetails($name, $description, $price, $stock, $origin, $type, $productID) {
        /* Sanitizing upd product fields */
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $price = filter_var($price, FILTER_SANITIZE_STRING);
        $stock = filter_var($stock, FILTER_SANITIZE_STRING);
        $origin = filter_var($origin, FILTER_SANITIZE_STRING);
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
        $startingHours = filter_var($startingHours, FILTER_SANITIZE_STRING);
        $closingHours = filter_var($closingHours, FILTER_SANITIZE_STRING);
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
        $productHasImage = self::query("SELECT * FROM `image`
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
        if ($productHasImage) {
            /* Delete image column from db */
            self::query("DELETE FROM `image` WHERE productID = ? ", $params);
            /* Delete image file from server */
                $filename = $productHasImage[0]['name'];
                if (file_exists('uploads/' . $filename)) {
                  unlink('uploads/' .$filename);
                } else {
                  echo 'Could not delete '.$filename.', file does not exist';
                }
        }
        self::query("DELETE FROM product WHERE productID = ? ", $params);
    }
    public function deleteProductImage($image) {
        self::query("DELETE FROM `image` WHERE `name` = ?", array($image));
        $filename = $image;
        if (file_exists('uploads/' . $filename)) {
          unlink('uploads/' .$filename);
        } else {
          echo 'Could not delete '.$filename.', file does not exist';
        }
    }
}
