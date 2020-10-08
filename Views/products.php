<?php
include('header.php');
?>
<div class="container">
    <div class="row justify-content-center">
        <h1>Products</h1>
    </div>
    <div class="row justify-content-center">
        <?php
        $products = new Products();
        foreach ($products->getProducts() as  $key => $value) {
            echo ('
            <div class="col-10 col-md-6 col-lg-4">
            <div class="card" style="width: 18rem;">
            <div class="card-body">
                    <img class="card-img-top" src="https://purepng.com/public/uploads/medium/purepng.com-coffee-beansfood-coffee-beans-grains-941524619810to5bo.png" alt="Card image cap">
                    <h5 class="card-title">' . $value['name'] . '</h5>
                    <p class="card-text">' . $value['description'] . '</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>');
        }
        ?>
    </div>
</div>