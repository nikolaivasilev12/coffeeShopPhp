<?php
include("header.php");
$index = new Index();
?>

<div class="container-fluid">
    <?php
    if (isset($_SESSION['permission'])) {
    ?>
        <h1 align="center">Welcome to the backend <?php echo $_SESSION['fname']; ?></h1>
    <?php
    }
    ?>
    <h1 align="center" class="mt-4 mb-3">Special products</h1>
    <div class="row mx-0 justify-content-center">
        <div id="carouselHome" class="carousel slide d-block w-50 w-md-100" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
                <?php
                $i = 1;
                foreach ($index->getSpecialProducts() as $value) {
                ?>
                    <li data-target="#carouselHome" data-slide-to="<?php echo $i; ?>"></li>
                <?php
                    $i++;
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php
                foreach ($index->getSpecialProducts() as $value) {
                    $i = 0;
                ?>
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="https://unblast.com/wp-content/uploads/2019/05/Paper-Pouch-Packaging-Mockup-2.jpg" alt="">
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
                foreach ($index->getSpecialProducts() as $value) {
                    if (!$counter) {
                        $counter = true;
                    } else {
                ?>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://unblast.com/wp-content/uploads/2019/05/Paper-Pouch-Packaging-Mockup-2.jpg" alt="">
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

    <div class="jumbotron jumbotron-fluid mb-0 mt-5">
        <div class="container">
            <h1 class="display-4">News</h1>
            <p class="lead"><?php echo ($index->getNews()['content']) ?></p>
        </div>
    </div>
</div>
<?php
include("footer.php");
?>
<style>
    .container-fluid {
        padding: 0 0 0 0;
    }

    .carousel-inner {
        height: 600px;
    }
    
    .carousel-item,
    img {
        height: 100% !important;
        width: 100% !important;
    }
    .btn-orange{background-color:#976C42;color: #FFF;}
    .btn-orange:hover{background-color:#49291F;color: #FFF;}
    @media (max-width: 1100px) {
    .w-md-100 {
        width: 100% !important;
    }
    }
</style>