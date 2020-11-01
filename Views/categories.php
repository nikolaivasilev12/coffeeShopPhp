<div class="container">
    <div class="row justify-content-center">
        <h1 style="margin-bottom: 3%;">Choose a Category</h1>
    </div>
    <div class="row justify-content-center">
        <a href="product?categoryID=0">
            <button style="margin: 5px;" class="btn btn-outline-dark" name="category" type="submit" value="0">All</button>
        </a>

        <?php
    $catArr = new Categories();
    foreach ($catArr->getCategory() as $value) {
    echo ('
                <a href="product?categoryID=' . $value['categoryID'] . '">
                    <button class="btn btn-outline-dark" style="margin: 5px;" name="category" type="submit" value="' . $value['categoryID'] . '">' . $value['name'] . '</button>
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
    foreach ($productsByCategory as $value) {?>
    <a href="product?productID=<?php echo $value['productID'] ?>" class="custom-card">
        <div class="product-item card col-3 mx-2 my-2 shadow p-3 mb-5 bg-white rounded">
            <div class="product-image">
            <img
            src="https://unblast.com/wp-content/uploads/2019/05/Paper-Pouch-Packaging-Mockup-2.jpg"
            id="<?php echo $value['productID']; ?>" width="100%;">
            </div>
            <div>
                <strong><?php echo $value["name"]; ?></strong>
            </div>
            <div class="product-price"><?php echo $value["price"] . " DKK"; ?></div>
            <?php if ($value['stock'] == 0) {?>
            <p class="mt-4">
                <strong>Out of stock</strong>
            </p>
            <?php
} else {?>
            <p>
                Currently in stock:
                <strong>
                    <?php echo $value["stock"]; ?>
                </strong>
            </p>
            </a>
            <button type="button" id="add_<?php echo $value['productID']; ?>" class="btn btn-orange" data-trigger="focus" data-toggle="popover" data-content="Added to cart"
                onClick="cartAction('add', '<?php echo $value['productID']; ?>','<?php echo $value["name"]; ?>','<?php echo $value["price"]; ?>', '<?php echo $value["stock"]; ?>')">
                Add to cart
            </button>
            <?php
}
        ?>
            <a href="product?productID=<?php echo $value['productID'] ?>"></a>
        </div>
        <?php
}
} elseif (!isset($_GET['productID'])) {
    $productsByCategory = $productsObj->getProductByCategory(0);
    foreach ($productsByCategory as $value) {?>
        <a href="product?productID=<?php echo $value['productID'] ?>" class="custom-card">
        <div class="product-item card col-3 mx-2 my-2 shadow p-3 mb-5 bg-white rounded">
            <div class="image">
                <img src="https://unblast.com/wp-content/uploads/2019/05/Paper-Pouch-Packaging-Mockup-2.jpg"
                    id="<?php echo $value['productID']; ?>" width="100%">
            </div>
            <div>
                <strong><?php echo $value["name"]; ?></strong>
            </div>
            <div class="product-price"><?php echo $value["price"] . " DKK"; ?></div>
            <?php if ($value['stock'] == 0) {?>
            <p class="mt-4">
                <strong>Out of stock</strong>
            </p>
            <?php
} else {?>
            <p>
                Currently in stock:
                <strong>
                    <?php echo $value["stock"]; ?>
                </strong>
            </p>
            </a>
            <button type="button" id="add_<?php echo $value['productID']; ?>" class="btn btn-orange" data-trigger="focus" data-toggle="popover" data-content="Added to cart"
                onClick="cartAction('add', '<?php echo $value['productID']; ?>','<?php echo $value["name"]; ?>','<?php echo $value["price"]; ?>','<?php echo $value["stock"]; ?>')">
                Add to cart
            </button>
            <?php
}
        ?>
            <a href="product?productID=<?php echo $value['productID'] ?>"></a>
        </div>
      
        <?php
}
}
?>
    </div>
</div>
<script> 
$("[data-toggle=popover]").popover();
</script>

<style>

.btn-orange{background-color:#976C42;color: #FFF;}
.btn-orange:hover{background-color:#49291F;color: #FFF;}

</style>