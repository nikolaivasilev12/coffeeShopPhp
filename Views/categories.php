<div class="container">
    <div class="row justify-content-center">
        <h1>Choose a Category</h1>
    </div>
    <div class="row justify-content-center">
        <a href="product?categoryID=0">
            <button name="category" type="submit" value="0">All</button>
        </a>

        <?php
    $catArr = new Categories();
    foreach ($catArr->getCategory() as $value) {
    echo ('
                <a href="product?categoryID=' . $value['categoryID'] . '">
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
    foreach ($productsByCategory as $value) {?>
        <div class="product-item card col-3 mx-2 my-2">
            <div class="product-image">
            <img
            src="https://purepng.com/public/uploads/large/purepng.com-coffee-beanscoffee-beanscoffeestone-fruitpeaberry-1411527241519iq7rh.png"
            id="<?php echo $value['productID']; ?>" width="150">
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
            <button type="button" id="add_<?php echo $value['productID']; ?>" class="btn btn-primary" data-trigger="focus" data-toggle="popover" data-content="Added to cart"
                onClick="cartAction('add', '<?php echo $value['productID']; ?>','<?php echo $value["name"]; ?>','<?php echo $value["price"]; ?>','<?php echo $value["price"]; ?>')">
                Add to cart
            </button>
            <?php
}
        ?>
            <a href="product?productID=<?php echo $value['productID'] ?>" class="btn btn-outline-primary">View Product</a>
        </div>
        <?php
}
} elseif (!isset($_GET['productID'])) {
    $productsByCategory = $productsObj->getProductByCategory(0);
    foreach ($productsByCategory as $value) {?>
        <div class="product-item card col-3 mx-2 my-2">
            <div class="image">
                <img src="https://purepng.com/public/uploads/large/purepng.com-coffee-beanscoffee-beanscoffeestone-fruitpeaberry-1411527241519iq7rh.png"
                    id="<?php echo $value['productID']; ?>" width="150">
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
            <button type="button" id="add_<?php echo $value['productID']; ?>" class="btn btn-primary" data-trigger="focus" data-toggle="popover" data-content="Added to cart"
                onClick="cartAction('add', '<?php echo $value['productID']; ?>','<?php echo $value["name"]; ?>','<?php echo $value["price"]; ?>','<?php echo $value["price"]; ?>')">
                Add to cart
            </button>
            <?php
}
        ?>
            <a href="product?productID=<?php echo $value['productID'] ?>" class="btn btn-outline-primary">View Product</a>
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