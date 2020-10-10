<?php
include('header.php');
$productsObj = new Products();
$productDetails = $productsObj->getProductDetails($_GET["productID"]);
?>
<div class="container">    
<div class="row">
    <div class="col-12 text-center">
        <h1>Product Name: <span class="text-color-red"> <?php print_r($productDetails['name']) ?></span></h1>
    </div>
    <div class="col-12">
        <p> <strong>Product Description:</strong> <?php print_r($productDetails['description']) ?></p>
    </div>    
    <div class="col-12">
        <p> <strong>Price:</strong> <?php print_r($productDetails['price']) ?> EUR</p>
    </div>
    <div class="col-12">
        <p> <strong>Origin:</strong> <?php print_r($productDetails['origin']) ?></p>
    </div>
    <div class="col-12">
        <p> <strong>Type:</strong> <?php print_r($productDetails['type']) ?></p>
    </div>
</div>
</div>