<?php

class Products extends Categories
{   
    public $productsArr;
    public function __construct($category) {
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
        $category = trim($category);
        $productsByCategory = (self::query("SELECT m.name, m.description, m.price, m.origin, m.type, m.isSpecial, m.productID
        FROM product as m
        INNER JOIN producthascategory as p
            ON m.productID = p.productID
        INNER JOIN category as cp
            ON p.categoryID = cp.categoryID
        WHERE cp.categoryID = ('{$category}')"));

        $this->productsArr = $productsByCategory;
    } 
}


?>