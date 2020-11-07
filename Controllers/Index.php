<?php

class Index extends Controller {
    public function getSpecialProducts() {
       $products = self::query("SELECT * FROM product WHERE isSpecial = 1");
         /* Check if each product contains an image and if it does add an image to the product's inner array */
         foreach ($products as $key => $product) {
            $productImage = $this->array_flatten(self::query("SELECT `name` FROM `image` WHERE productID = ? ", array($product['productID'])));
            if (!empty($productImage['name'])){
              $products[$key]['image'] = $productImage['name'];
            }
          }
        return $products;
    }
    public function getNews() {
        return $this->array_flatten(self::query("SELECT * FROM news"));
    }
    public function getCompanyData() {
        return $this->array_flatten(self::query("SELECT * FROM companydata"));
    }
    public function getWorkdays() {
        return (self::query("SELECT * FROM workdays"));
    }
    
}