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
        // $products = new Products();
        foreach ($catArr->getCategory() as  $value) {
            echo ('
            <form action="" method="post">
                <button name="category" type="submit" value="' . $value['categoryID'] . '">' . $value['name'] . '</button>
            </form>
                ');
                // <input name="category" type="submit" value="' . $value['categoryID'] . '">' . $value['name'] . '</input>
        }
        ?>
    </div>
    <div class="row justify-content-center">
        <?php
        if (isset($_POST['category'])) {
            $productsObj = new Products();
            $productsByCategory = $productsObj->getProductByCategory($_POST['category']);
            foreach ($productsByCategory as $value) {
                echo ('
        <div class="col-4">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">' . $value['name'] . '</h5>
                <h6 class="card-subtitle mb-2 text-muted">ID: ' . $value['productID'] . '</h6>
                <p class="card-text">' . $value['description'] . '</p>
                <a href="product?productID='. $value['productID'] .'"> 
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