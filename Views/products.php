<?php
include('header.php');
$productsObj = new Products();
if (isset($_GET["productID"])) {
    $productDetails = $productsObj->getProductDetails($_GET["productID"]);
}
?>
<div class="container">
    <div class="row">
        <?php if (isset($_GET["productID"])) {
            echo ('
<div class="row">
    <div class="col-12 text-center">
        <h1>Product Name: <span class="text-color-red">' . $productDetails["name"] . '</span></h1>
    </div>
    <div class="col-12">
        <p> <strong>Product Description:</strong>' . $productDetails["description"] . '</p>
    </div>    
    <div class="col-12">
        <p> <strong>Price:</strong>' . $productDetails["price"] . ' EUR</p>
    </div>
    <div class="col-12">
        <p> <strong>Origin:</strong>' . $productDetails["origin"] . '</p>
    </div>
    <div class="col-12">
        <p> <strong>Type:</strong>' . $productDetails["type"] . '</p>
    </div>
</div>
');
        } else {
            echo ('
    <div class="col-12 text-center">
        <h1> All Products </h1>
    </div>
    ');
            foreach ($productsObj->getAllProducts() as $value) {
                echo ('
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">' . $value['name'] . '</h5>
                    <p class="card-text">' . $value['description'] . '</p>
                    <p class="card-text">Price:' . $value['price'] . '</p>
                    <a href="product?productID=' . $value['productID'] . '" class="btn btn-primary">View Product</a>
                </div>
            </div>
        </div>
            ');
            }
        }
        ?>
    </div>
</div>