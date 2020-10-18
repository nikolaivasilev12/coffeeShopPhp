<?php
include('header.php');
$productsObj = new Products();
if (isset($_GET["productID"])) {
    $productDetails = $productsObj->getProductDetails($_GET["productID"]);
}
?>
<style>
    <?php include 'style.css'; ?>
</style>
<div class="container">
    <div class="row justify-content-center">
        <?php if (!isset($_GET["productID"])) {
            ?>
            <div class="col-12" id="shopping-cart" tabindex="1">
                <div id="tbl-cart">
                    <div id="txt-heading">
                        <h2>Your Shopping Cart</h2>
                        <div id="close"></div>
                    </div>
                    <div id="cart-item">
                        <?php require_once 'components/cart.php'; ?>
                        </div>
                </div>
            </div>
            <div class="col-12">
                <a href="checkout">
                    <button class="btn btn-primary" "> Checkout</button>
                </a>
            </div>
            <?php
        }
        else { ?>
            </div>
            <div class="heading">Products</div>
            <div class="col-12 text-center">
                <h1>Product Name: <span class="text-color-red"><?php echo $productDetails['name'] ?></span></h1>
            </div>
            <div class="col-12">
                <p> <strong>Product Description:</strong><?php echo $productDetails['description'] ?></p>
            </div>
            <div class="col-12">
                <p> <strong>Price:</strong><?php echo $productDetails['price'] ?> EUR</p>
            </div>
            <div class="col-12">
                <p> <strong>Origin:</strong><?php echo $productDetails['origin'] ?></p>
            </div>
            <div class="col-12">
                <p> <strong>Type:</strong><?php echo $productDetails['type'] ?></p>
            </div>
            <div class="col-12">
                <p> <strong>Stock:</strong><?php echo $productDetails['stock'] ?></p>
            </div>
            <div class="col-12">
                <a href="product?action=add&name=<?php echo($productDetails["name"]); ?>" class="btn btn-primary">Add to Shopping Cart</a>
            </div>
            <?php
            $catObj = new Categories();
            if ($catObj->getProductCategory($_GET["productID"])) {
            ?>
                <div class="col-12 text-center">
                    <h3>More products from the same category</h3>
                </div>
                <div id="carouselHome" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselHome" data-slide-to="0" class="active"></li>'
                        <?php
                        $getProductCategory = $catObj->getProductCategory($_GET["productID"])['categoryID'];
                        $i = 1;
                        foreach ($productsObj->getProductByCategory($getProductCategory) as $value) {
                        ?>
                            <li data-target="#carouselHome" data-slide-to="<?php echo ($i) ?>"></li>
                        <?php
                            $i++;
                        }
                        ?>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <?php
                            foreach ($productsObj->getProductByCategory($getProductCategory) as $value) {
                                $i = 0;
                            ?>
                                <div class="d-block w-100">
                                    <div class="card" style="width: 18rem; background-color:gray">
                                        <div class="card-body">
                                            Category:
                                            <h5 class="card-title"><?php echo $value['name'] ?></h5>
                                            <p class="card-text"><?php echo $value['description'] ?></p>
                                            <p class="card-text">Price:<?php echo $value['price'] ?></p>
                                            <a href="product?productID=<?php echo $value['productID'] ?>" class="btn btn-primary">View Product</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i++;
                                if ($i > 0) {
                                    break;
                                }
                            };
                            echo ('</div>');
                            $counter = false;
                            foreach ($productsObj->getProductByCategory($getProductCategory) as $value) {
                                if (!$counter) {
                                    $counter = true;
                                } else {
                                ?>
                                    <div class="carousel-item">
                                        <div class="d-block w-100">
                                            <div class="card" style="width: 18rem; background-color:gray">
                                                <div class="card-body">
                                                    Category:
                                                    <h5 class="card-title"><?php echo $value['name'] ?></h5>
                                                    <p class="card-text"><?php echo $value['description'] ?></p>
                                                    <p class="card-text">Price:<?php echo $value['price'] ?></p>
                                                    <a href="product?productID=<?php echo $value['productID'] ?>" class="btn btn-primary">View Product</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            };
                            ?>
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
            <?php
            }
        }
        if (!isset($_GET['productID'])) {
            include('categories.php');
        }
            ?>
                </div>
    </div>
    
<script src="cartJS"></script>