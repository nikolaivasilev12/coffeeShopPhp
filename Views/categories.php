<style> <?php include 'style.css'; ?> </style>
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
        foreach ($catArr->getCategory() as  $value) {
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
            foreach ($productsByCategory as $value) { ?>
                <div class="product-item">
                    <?php echo(($value["name"])); ?>
                        <form method="post" action="product?action=add&name=<?php echo(trim($value["name"])); ?>"> 
                        <div><strong><?php echo $value["name"]; ?></strong></div>
                        <div class="product-price"><?php echo $value["price"]." DKK"; ?></div>
                        <div>
                            <input type="text" name="quantity" value="1" size="2" />
                            <input type="submit" value="Add to cart" class="addBtn" />
                            <a href="product?productID=<?php echo($value['productID']) ?>" class="btn btn-primary">View Product</a></div>
                        </form>
                    </div>
                <?php
            }
        } elseif (!isset($_GET['productID'])) {
            $productsByCategory = $productsObj->getProductByCategory(0);
            foreach ($productsByCategory as $value) { ?>
                <div class="product-item">
                    <?php echo(($value["name"])); ?>
                        <form method="post" action="product?action=add&name=<?php echo(trim($value["name"])); ?>"> 
                        <div><strong><?php echo $value["name"]; ?></strong></div>
                        <div class="product-price"><?php echo $value["price"]." DKK"; ?></div>
                        <div>
                            <input type="text" name="quantity" value="1" size="2" />
                            <input type="submit" value="Add to cart" class="addBtn" />
                            <?php echo $value['productID']?>
                            <a href="product?productID=<?php echo($value['productID']) ?>" class="btn btn-primary">View Product</a></div>
                        </form>
                    </div>
                <?php
            }
        }
        ?>
    </div>

</div>