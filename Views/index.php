<?php
include("header.php");
$index = new Index();
?>

<div class="container">
    <?php
    if (isset($_SESSION['permission'])) {
    ?>
     <h1 align="center">Welcome to the backend <?php echo $_SESSION['fname']; ?></h1>
     <?php
    }
     ?>
    <h1 align="center">Special products</h1>
    <div class="row justify-content-center">
        <div id="carouselHome" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
                <?php
                $i = 1;
                foreach ($index->getSpecialProducts() as $value) {
                    echo ('<li data-target="#carouselHome" data-slide-to="' . $i . '"></li>');
                    $i++;
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <?php
                    foreach ($index->getSpecialProducts() as $value) {
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
                    }
                    ?>
                </div>
                <?php
                $counter = false;
                foreach ($index->getSpecialProducts() as $value) {
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
    <div class="row justify-content-center mt-4">
        <div class="col">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                <h1 class="display-4">News</h1>
                <p class="lead"><?php echo($index->getNews()['content']) ?></p>
            </div>
        </div>
    </div>
    </div>
</div>
<?php
include("footer.php");
?>
