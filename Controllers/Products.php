<?php

class Products extends Categories
{   
    public function getProductByCategory($category) {
      $category = trim($category);
      $productsByCategory = (self::query("SELECT m.name, m.description, m.price, m.origin, m.type, m.isSpecial, m.productID
        FROM product as m
        INNER JOIN producthascategory as p
            ON m.productID = p.productID
        INNER JOIN category as cp
            ON p.categoryID = cp.categoryID
        WHERE cp.categoryID = ('{$category}')"));

      return $productsByCategory;
    }
    public function getProductDetails($productID) {
      function array_flatten($array) { 
        if (!is_array($array)) { 
          return false; 
        } 
        $result = array(); 
        foreach ($array as $key => $value) { 
          if (is_array($value)) { 
            $result = array_merge($result, array_flatten($value)); 
          } else { 
            $result = array_merge($result, array($key => $value));
          } 
        } 
        return $result; 
      }
      $productDetails = array_flatten(self::query("SELECT * FROM product WHERE productID = '{$productID}'"));
      return($productDetails);
    }
}


?>