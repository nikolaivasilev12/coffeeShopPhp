<?php

class Products extends Categories
{   
    public $productsArr;
    public function __construct($category) {
        $category = trim($category);
        $productsId = (self::query("SELECT productID FROM `producthascategory` WHERE categoryID = ('{$category}')"));
        $products = array(); 
            // print_r($category);
            function array_flatten($products) { 
                if (!is_array($products)) { 
                  return FALSE; 
                } 
                $result = array(); 
                foreach ($products as $key => $value) { 
                  if (is_array($value)) { 
                    $result = array_merge($result, array_flatten($value)); 
                  } 
                  else { 
                    $result[$key] = $value; 
                  } 
                } 
                return $result; 
              } 
            foreach ($productsId as $value) {
                $productByCategory = array_flatten(self::query("SELECT * FROM product where productID = '$value[productID]'"));
                // print_r($productByCategory);
                array_push($products,$productByCategory);
            }
            // print_r(array_flatten($products));
        $this->productsArr = $products;
    } 
}


?>