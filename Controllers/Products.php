<?php

class Products extends Categories
{
    public function getProductByCategory($data) {
      if (isset($data['carouselCategory'])) {
        $products = (self::query("SELECT m.name, m.description, m.price, m.origin, m.type, m.stock, m.isSpecial, m.productID
          FROM product as m
          INNER JOIN producthascategory as p
              ON m.productID = p.productID
          INNER JOIN category as cp
              ON p.categoryID = cp.categoryID
          WHERE cp.categoryID = ('{$data['carouselCategory']}')"));

        /* Check if each product contains an image and if it does add an image to the product's inner array */
          foreach ($products as $key => $product) {
            $productImage = $this->array_flatten(self::query("SELECT `name` FROM `image` WHERE productID = ? ", array($product['productID'])));
            if (!empty($productImage['name'])){
              $products[$key]['image'] = $productImage['name'];
            }
          }
          return $products;
      }
      elseif(isset($data['category']) && $data['category'] == 0) {
        $page = $data['page'];
        $rowsPerPage= 9;
        $startLimit = ($page - 1) * $rowsPerPage;
        $products = self::query("SELECT * FROM product LIMIT {$startLimit}, {$rowsPerPage}");
        /* Check if each product contains an image and if it does add an image to the product's inner array */
        foreach ($products as $key => $product) {
          $productImage = $this->array_flatten(self::query("SELECT `name` FROM `image` WHERE productID = ? ", array($product['productID'])));
          if (!empty($productImage['name'])){
            $products[$key]['image'] = $productImage['name'];
          }
        }
        return $products;
      } 
       elseif (isset($data['category'])) {
        $page = $data['page'];
        $rowsPerPage= 9;
        $startLimit = ($page - 1) * $rowsPerPage;
        $products = (self::query("SELECT m.name, m.description, m.price, m.origin, m.type, m.stock, m.isSpecial, m.productID
          FROM product as m
          INNER JOIN producthascategory as p
              ON m.productID = p.productID
          INNER JOIN category as cp
              ON p.categoryID = cp.categoryID
          WHERE cp.categoryID = ('{$data['category']}') LIMIT {$startLimit}, {$rowsPerPage}"));

        /* Check if each product contains an image and if it does add an image to the product's inner array */
          foreach ($products as $key => $product) {
            $productImage = $this->array_flatten(self::query("SELECT `name` FROM `image` WHERE productID = ? ", array($product['productID'])));
            if (!empty($productImage['name'])){
              $products[$key]['image'] = $productImage['name'];
            }
          }
          return $products;
      }
    }
    
    public function getProductsPages($categoryID){
      if($categoryID == 0) {
        $products = self::query("SELECT COUNT(*) as count FROM product");
        return floor(($products[0]['count']-0.5)/9);
      }else {
        $products = self::query("SELECT COUNT(*) as count FROM product as m
        INNER JOIN producthascategory as p
            ON m.productID = p.productID
        INNER JOIN category as cp
            ON p.categoryID = cp.categoryID
        WHERE cp.categoryID = ('{$categoryID}')");
        return floor(($products[0]['count']-0.5)/9);
      }
    }

    public function getProductDetails($productID) {
      $productDetails = $this->array_flatten(self::query("SELECT * FROM product WHERE productID = '{$productID}'"));
      $productImage = $this->array_flatten(self::query("SELECT `name` FROM `image` WHERE productID = ? ", array($productID)));
      /* Check if this product contains an image */
      if (!empty($productImage['name'])){
        /* If more than one image exists add each image to an inner array in productDetails called `images` and assign a key to each item in it */
        if (count($productImage) > 2) {
          foreach ($productImage as $key => $image) {
            $productDetails['images'][$key] = $image;
          }
        /* Remove the initial productImage from productDetails with an index of `name` */
          unset($productDetails['images']['name']);
        } else {
          $productDetails['image'] = $productImage['name'];
        }
      }
      return $productDetails;
    }
    public function getProductImage($productID) {
      return $this->array_flatten(self::query("SELECT * FROM `image` WHERE productID = '{$productID}'"));
    }
}
?>


