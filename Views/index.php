<?php
include("header.php");
$index = new Index();
?>
<div class="container">
<h1 align="center">Welcome to the backend <?php echo $_SESSION['fname']; ?></h1>
<h1 align="center">Special products</h1>
<div class="row">
<?php
foreach ($index->getSpecialProducts() as $value) {
    echo ('
    <div class="col">
    <div class="card" style="width: 18rem;">
    <div class="card-body">
    Category:
    <strong>
    </strong>
                <h5 class="card-title">' . $value['name'] . '</h5>
                <p class="card-text">' . $value['description'] . '</p>
                <p class="card-text">Price:' . $value['price'] . '</p>
                <a href="edit-products?productID=' . $value['productID'] . '" class="btn btn-primary">Edit Product</a>
            </div>
        </div>
    </div>
        ');
}
?>
</div>
</div>