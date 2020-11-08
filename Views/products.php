<?php
include('header.php');
$index = new Index();
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
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-8" id="shopping-cart" tabindex="1">
                        <div id="tbl-cart">
                            <div id="cart-item">
                                <?php require_once 'components/cart.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <button class="btn btn-warning mt-2" id="show-cart" onclick="myFunction()" type="button">
                        Show cart
                    </button>
                </div>
            </div>
        <?php
        } else { ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 bg-orange p-2 text-white mt-2 text-center text-capitalize">
                <h2>Product Name: <span><?php echo $productDetails['name'] ?></span></h2>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-1 text-center">
                <?php
                    if (isset($productDetails['images'])) 
                    {
                        ?>
                        <ul class="nav nav-tabs row text-center pro-details" id="myTab" role="tablist">
                            <?php
                            foreach ($productDetails['images'] as $key => $image) {
                            ?>
                            <li class="nav-item col-lg-12 mb-2">
                                <img class="img-fluid <?php if ($key == 0) { ?>
                                    active 
                                    <?php } ?> h-100" 
                                    src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("uploads/{$image}")); ?>"
                                    id="home-tab-<?php echo $key;?>" 
                                    data-toggle="tab" 
                                    href="#home-<?php echo $key;?>" 
                                    role="tab" 
                                    aria-controls="home-<?php echo $key; ?>"
                                    aria-selected="<?php 
                                    if ($key == 0) {
                                    ?>true<?php
                                    } else { ?>false<?php }
                                    ?>" 
                                />
                            </li>
                            <?php
                            } 
                            ?>
                        </ul>
                        <?php
                    } 
                    ?>
            </div>
            <div class="col-lg-4 text-center border-right border-secondery">
                <div class="tab-content row h-100 d-flex justify-content-center align-items-center" id="myTabContent">
                    <?php
                    if (isset($productDetails['images'])) {
                        foreach ($productDetails['images'] as $key => $image) {
                        ?>
                        <div 
                            class="tab-pane fade<?php
                            if ($key == 0) {
                            ?> show active<?php
                            }
                            ?>
                            col-lg-12"
                            id="home-<?php echo $key; ?>" 
                            role="tabpanel" 
                            aria-labelledby="home-tab-<?php echo $key; ?>"
                        >
                            <img class="img-fluid" src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("uploads/{$image}")); ?>" />
                        </div>
                    <?php
                        }
                    } else if (isset($productDetails['image'])) {
                        ?>
                        <div 
                            class="tab-pane fade show active col-lg-12"
                            id="home" 
                            role="tabpanel" 
                            aria-labelledby="home-tab"
                        >
                            <img class="img-fluid" src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("uploads/{$productDetails['image']}")); ?>" />
                        </div>
                    <?php
                    } else {
                        ?>
                        <img src="https://unblast.com/wp-content/uploads/2019/05/Paper-Pouch-Packaging-Mockup-2.jpg"
                        id="<?php echo $productDetails['productID']; ?>" width="100%">
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-7">
                <h5>
                    <?php echo $productDetails['name'] ?>
                </h5>
                <h3>
                    <?php echo $productDetails['price'] ?> DKK
                </h3>
                <ul>
                    <p class="pb-2 text-left"><b>Description:</b> <br /> <?php echo $productDetails['description'] ?></p>
                    <p class="pb-2 text-left"><b>Origin:</b> <br /> <?php echo $productDetails['origin'] ?></p>
                    <p class="pb-2 text-left"><b>Type:</b> <br /> <?php echo $productDetails['type'] ?></p>
                    <p class="pb-2 text-left"><b>Currently in stock:</b> <br /> <?php echo $productDetails['stock'] ?></p>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 mb-5">
        <a href="product?action=add&name=<?php echo ($productDetails["name"]); ?>" class="btn btn-orange">Add to Shopping Cart</a>
    </div>
    <?php
            $catObj = new Categories();

            $getProductCategory = $catObj->getProductCategory($_GET["productID"]);
            if (isset($getProductCategory['categoryID'])){
                $getProductCategory = $catObj->getProductCategory($_GET["productID"])['categoryID'];
                $arr = array(
                    'carouselCategory' => $getProductCategory
                );
                if (count($productsObj->getProductByCategory($arr)) > 1) {
    ?>
        <div class="col-12 text-center mt-5 mb-3">
            <h3>More products from the same category</h3>
        </div>

        <div class="row justify-content-center mb-5">
            <div id="carouselHome" class="carousel slide d-block w-50 w-md-100" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
                    <?php
                    $i = 1;
                    $arr = array(
                        'carouselCategory' => $getProductCategory
                    );
                    foreach ($productsObj->getProductByCategory($arr) as $value) {
                    ?>
                        <li data-target="#carouselHome" data-slide-to="<?php echo $i; ?>"></li>
                    <?php
                        $i++;
                    }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                    $arr = array(
                        'carouselCategory' => $getProductCategory
                    );
                    foreach ($productsObj->getProductByCategory($arr) as $value) {
                        $i = 0;
                    ?>
                        <div class="carousel-item active">
                            <img class="d-block w-100" 
                            <?php 
                            if (isset($value['image'])) 
                            { ?>
                                src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("uploads/{$value['image']}")); ?>"
                            <?php
                            } else {
                            ?>
                                src="https://unblast.com/wp-content/uploads/2019/05/Paper-Pouch-Packaging-Mockup-2.jpg"
                            <?php
                            }
                            ?>
                            alt="">
                            <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.5);">
                                <div class="card-body">
                                    Category:
                                    <h5 class="card-title"><?php echo $value['name'] ?></h5>
                                    <p class="card-text"><?php echo $value['description'] ?></p>
                                    <p class="card-text">Price: <?php echo $value['price'] ?></p>
                                    <a href="product?productID=<?php echo $value['productID'] ?>" class="btn btn-orange">View Product</a>
                                </div>
                            </div>
                        </div>
                    <?php
                        $i++;
                        if ($i > 0) {
                            break;
                        }
                    }
                    ?>
                    <?php
                    $counter = false;
                    $arr = array(
                        'carouselCategory' => $getProductCategory
                    );
                    foreach ($productsObj->getProductByCategory($arr) as $value) {
                        if (!$counter) {
                            $counter = true;
                        } else {
                    ?>
                            <div class="carousel-item">
                                <img class="d-block w-100" 
                                <?php 
                                if (isset($value['image'])) 
                                { ?>
                                    src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("uploads/{$value['image']}")); ?>"
                                <?php
                                } else {
                                ?>
                                    src="https://unblast.com/wp-content/uploads/2019/05/Paper-Pouch-Packaging-Mockup-2.jpg"
                                <?php
                                }
                                ?> 
                                alt="">
                                <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.5);">
                                    <div class="card-body">
                                        Category:
                                        <h5 class="card-title"><?php echo $value['name'] ?></h5>
                                        <p class="card-text"><?php echo $value['description'] ?></p>
                                        <p class="card-text">Price: <?php echo $value['price'] ?></p>
                                        <a href="product?productID=<?php echo $value['productID'] ?>" class="btn btn-orange">View Product</a>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
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
        </div>
    <?php
    }   
    }
        }
        if (!isset($_GET['productID'])) {
            include('categories.php');
        }
?>
</div>
</div>
<?php
include("footer.php");
?>
<script>
    $(document).ready(function() {
        // hide shopping-cart on page load
        $('#shopping-cart').hide();
    });

    function myFunction() {
        var x = document.getElementById("shopping-cart");
        var y = document.getElementById("show-cart")
        if (x.style.display === "none") {
            x.style.display = "block";
            y.innerHTML = "Hide Cart";
        } else {
            x.style.display = "none";
            y.innerHTML = "Show Cart";
        }
    }
</script>
<style>
    .bg-orange {
        background-color: #976C42;
        color: #FFF;
    }

    .btn-orange {
        background-color: #976C42;
        color: #FFF;
    }

    .btn-orange:hover {
        background-color: #49291F;
        color: #FFF;
    }
</style>