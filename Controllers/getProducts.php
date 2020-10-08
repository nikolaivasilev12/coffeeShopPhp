<?php 
$products = new Products();
$productsByCategory = $products->getProductsByCategory(1);
print_r($productsByCategory);

?>