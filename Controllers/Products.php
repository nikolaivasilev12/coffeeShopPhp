<html>
<body>


<?php

class Products extends Categories
{   
    public function getAllProducts() {
      return self::query("SELECT * FROM product");
    }
    public function getProductByCategory($category) {
      $category = trim($category);
      if($category == 0) {
        return self::query("SELECT * FROM product");
      } else {
        return (self::query("SELECT m.name, m.description, m.price, m.origin, m.type, m.stock, m.isSpecial, m.productID
          FROM product as m
          INNER JOIN producthascategory as p
              ON m.productID = p.productID
          INNER JOIN category as cp
              ON p.categoryID = cp.categoryID
          WHERE cp.categoryID = ('{$category}')")) ;
      }
    }
    public function getProductDetails($productID) {
      return $this->array_flatten(self::query("SELECT * FROM product WHERE productID = '{$productID}'"));
    }
   
}
?>

</body>
</html>


