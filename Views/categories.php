<?php
include('header.php');
?>
<style> <?php include 'style.css'; ?> </style>
<div class="container">
    <div class="row justify-content-center">
        <h1>Choose a Category</h1>
    </div>
    <div class="row justify-content-center">
        <?php
        $catArr = new Categories();
        foreach ($catArr->getCategory() as  $value) {
            echo ('
                <a href="categories?categoryID=' . $value['categoryID'] . '">
                    <button name="category" type="submit" value="' . $value['categoryID'] . '">' . $value['name'] . '</button>
                </a>&nbsp;
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
                            <p class="card-text">' . $value['description'] . '</p>
                            <p class="card-text">Price:' . $value['price'] . '</p>
                            <a href="product?productID=' . $value['productID'] . '" class="btn btn-primary">Edit Product</a>
                        </div>
                    </div>
                </div>
        ');
            }
        }
        ?>
    </div>

</div>