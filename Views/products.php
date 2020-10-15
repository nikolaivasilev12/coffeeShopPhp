<?php
include('header.php');
$productsObj = new Products();
if (isset($_GET["productID"])) {
    $productDetails = $productsObj->getProductDetails($_GET["productID"]);
}

?>
<style> <?php include 'style.css'; ?> </style>
<div class="container">
    <div class="row justify-content-center">
        <?php if (isset($_GET["productID"])) {
            echo ('
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
                <div class="col-12">
                <p> <strong>Stock:</strong>' . $productDetails["stock"] . '</p>
                </div> 
                <div class="col-12">
                <a href="cart.php'. '" class="btn btn-primary">Add to Shopping Cart</a>
                <input type="submit" value="Add to Cart" class="addBtn" />
                </div> 
                
               
            ');
            
            $catObj = new Categories();
            if($catObj->getProductCategory($_GET["productID"])){
                echo('
                    <div class="col-12 text-center">
                        <h3>More products from the same category</h3>
                    </div>
                ');
                $getProductCategory = $catObj->getProductCategory($_GET["productID"])['categoryID'];
                echo('
                <div id="carouselHome" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselHome" data-slide-to="0" class="active"></li>');
                $i = 1;
                foreach ($productsObj->getProductByCategory($getProductCategory) as $value) {
                    echo ('<li data-target="#carouselHome" data-slide-to="' . $i . '"></li>');
                    $i++;
                }
                echo('</ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">');
                    foreach ($productsObj->getProductByCategory($getProductCategory) as $value) {
                        $i = 0;
                        echo ('
                        <div class="d-block w-100">
                            <div class="card" style="width: 18rem; background-color:gray">
                                <div class="card-body">
                                Category:
                                    <h5 class="card-title">' . $value['name'] . '</h5>
                                    <p class="card-text">' . $value['description'] . '</p>
                                    <p class="card-text">Price:' . $value['price'] . '</p>
                                    <a href="product?productID=' . $value['productID'] . '" class="btn btn-primary">View Product</a>
                                </div>
                            </div>
                        </div>
                        ');
                        $i++;
                        if ($i > 0) {
                            break;
                        }
                    };
                echo('</div>');
                $counter = false;
                foreach ($productsObj->getProductByCategory($getProductCategory) as $value) {
                    if (!$counter) {
                        $counter = true;
                    } else {
                        echo ('
                        <div class="carousel-item">
                        <div class="d-block w-100">
                            <div class="card" style="width: 18rem; background-color:gray">
                                <div class="card-body">
                                Category:
                                    <h5 class="card-title">' . $value['name'] . '</h5>
                                    <p class="card-text">' . $value['description'] . '</p>
                                    <p class="card-text">Price:' . $value['price'] . '</p>
                                    <a href="product?productID=' . $value['productID'] . '" class="btn btn-primary">View Product</a>
                                </div>
                            </div>
                        </div>
                        </div>
                        ');
                    }
                };
                echo ('
                </div>
                <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            ');
            }

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
