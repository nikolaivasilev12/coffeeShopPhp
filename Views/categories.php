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
            <a  onclick="' . $value['name'] . ')" >
            <form action="" method="post">
                <input name="category" type="submit" value="' . $value['categoryID'] . '">' . $value['name'] . '</input>
            </form>
            </a>
            ');
        }
        ?>
    </div>
    <div class="row justify-content-center">
        <?php
        if (isset($_POST['category'])) {
            $productsObj = new Products($_POST['category']);
            $products = $productsObj->productsArr;
            // print_r($products);
            foreach ($products as $value) {
                echo ('
        <div class="col-4">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">' . $value['name'] . '</h5>
                <h6 class="card-subtitle mb-2 text-muted">ID: ' . $value['productID'] . '</h6>
                <p class="card-text">' . $value['description'] . '</p>
                <button href="#" class="card-link">Price:' . $value['price'] . '</button>
            </div>
        </div>
        </div>
        ');
            }
        }
        ?>
    </div>

</div>