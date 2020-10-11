<?php
include('header.php');
?>
<div class="container">
    <div class="row justify-content-center">
        <h1>Pick a category</h1>
    </div>
    <div class="row justify-content-center">
        <?php
        $catArr = new Categories();
        foreach ($catArr->getCategory() as  $value) {
            echo ('
                <a href="categories?categoryID=' . $value['categoryID'] . '">
                    <button name="category" type="submit" value="' . $value['categoryID'] . '">' . $value['name'] . '</button>
                </a>
                ');
        }
        ?>
    </div>
    <div class="row justify-content-center">
        <?php
        if (isset($_GET['categoryID'])) {
            $productsObj = new Products();
            $productsByCategory = $productsObj->getProductByCategory($_GET['categoryID']);
            foreach ($productsByCategory as $value) {
                echo ('
        <div class="col-4">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">' . $value['name'] . '</h5>
                <h6 class="card-subtitle mb-2 text-muted">ID: ' . $value['productID'] . '</h6>
                <p class="card-text">' . $value['description'] . '</p>
                <a href="product?productID=' . $value['productID'] . '"> 
                    <button href="/email" class="card-link">Price:' . $value['price'] . '</button>
                </a>
            </div>
        </div>
        </div>
        ');
            }
        }
        ?>
    </div>

</div>