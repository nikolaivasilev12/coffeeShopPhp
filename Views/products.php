<?php
include('header.php');
$productsObj = new Products();
if (isset($_GET["productID"])) {
    $productDetails = $productsObj->getProductDetails($_GET["productID"]);
}
?>
<style>
    <?php include 'style.css'; ?>
</style>
<div class="container">
    <div class="row justify-content-center">
        <?php if (!isset($_GET["productID"])) {
            $cartController = new CartController();
            if (isset($_SESSION['/'])) {
                $cartController->existingCart($_SESSION["cart_item"]);
            }
            if (!empty($_GET["action"])) {
                if (isset($_GET['name'])) {
                    $name = $_GET['name'];
                }

                //start the switch/case
                switch ($_GET["action"]) {
                        //adding items to cart
                    case "add":
                        if (!empty($_POST["quantity"])) {
                            $productByName = self::query("SELECT * FROM product WHERE `name`='" . $_GET["name"] . "'");
                            $itemArray = array(
                                $productByName[0]["name"] => array(
                                    'name' => $productByName[0]["name"],
                                    'type' => $productByName[0]["type"],
                                    'quantity' => $_POST["quantity"],
                                    'price' => $productByName[0]["price"]
                                )
                            );

                            if (!empty($_SESSION["cart_item"])) {
                                if (in_array($productByName[0]["name"], array_keys($_SESSION["cart_item"]))) {
                                    foreach ($_SESSION["cart_item"] as $k => $v) {
                                        if ($productByName[0]["name"] == $k) {
                                            if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                                $_SESSION["cart_item"][$k]["quantity"] = 0;
                                            }
                                            $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                        }
                                    }
                                } else {
                                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                                }
                            } else {
                                $_SESSION["cart_item"] = $itemArray;
                            }
                        }
                        break;
                        //Remove item from cart
                    case "remove":
                        if (!empty($_SESSION["cart_item"])) {
                            foreach ($_SESSION["cart_item"] as $k => $v) {
                                if ($_GET["name"] == $k)
                                    unset($_SESSION["cart_item"][$k]);
                                if (empty($_SESSION["cart_item"]))
                                    unset($_SESSION["cart_item"]);
                            }
                        }
                        break;
                        //Empty the entire cart
                    case "empty":
                        unset($_SESSION["cart_item"]);
                        break;
                }
            }
        ?>


            <title>Shopping Cart</title>
            <div id="shopping-cart">
                <div class="heading">Shopping Cart
                    <a id="btnEmpty" href="product?action=empty">Empty Cart</a></div>
                <?php
                //Reset total cost to do recalc
                if (isset($_SESSION["cart_item"])) {
                    $item_total = 0;
                ?>
                    <table class="cart" cellpadding="10" cellspacing="1">
                        <tbody>
                            <tr>
                                <th><strong>Name</strong></th>
                                <th><strong>Type</strong></th>
                                <th><strong>Quantity</strong></th>
                                <th><strong>Price</strong></th>
                                <th><strong>Action</strong></th>
                            </tr>
                            <?php
                            foreach ($_SESSION["cart_item"] as $item) {
                                $item_price = $item["quantity"] * $item["price"];
                            ?>
                                <tr>
                                    <td><strong><?php echo $item["name"]; ?></strong></td>
                                    <td><?php echo $item["type"]; ?></td>
                                    <td><?php echo $item["quantity"]; ?></td>
                                    <td><?php echo $item["price"] . " DKK"; ?></td>
                                    <td><a href="product?action=remove&name=<?php echo $item["name"]; ?>" class="removeBtn">Remove</a></td>
                                </tr>
                            <?php
                                $item_total += ($item["price"] * $item["quantity"]);
                            }
                            ?>

                            <tr>
                                <td colspan="5" align=right><strong>Total:</strong> <?php echo $item_total . " DKK"; ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                } else {
                ?>
                    <div class="no-records">Your cart is Empty</div>
                <?php
                }
                ?>
            </div>
            <div class="heading">Products</div>
        <?php
        } else { ?>
            <div class="col-12 text-center">
                <h1>Product Name: <span class="text-color-red"><?php echo $productDetails['name'] ?></span></h1>
            </div>
            <div class="col-12">
                <p> <strong>Product Description:</strong><?php echo $productDetails['description'] ?></p>
            </div>
            <div class="col-12">
                <p> <strong>Price:</strong><?php echo $productDetails['price'] ?> EUR</p>
            </div>
            <div class="col-12">
                <p> <strong>Origin:</strong><?php echo $productDetails['origin'] ?></p>
            </div>
            <div class="col-12">
                <p> <strong>Type:</strong><?php echo $productDetails['type'] ?></p>
            </div>
            <div class="col-12">
                <p> <strong>Stock:</strong><?php echo $productDetails['stock'] ?></p>
            </div>
            <div class="col-12">
                <a href="product?action=add&name=<?php echo($productDetails["name"]); ?>" class="btn btn-primary">Add to Shopping Cart</a>
            </div>
            <?php
            $catObj = new Categories();
            if ($catObj->getProductCategory($_GET["productID"])) {
            ?>
                <div class="col-12 text-center">
                    <h3>More products from the same category</h3>
                </div>
                <div id="carouselHome" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselHome" data-slide-to="0" class="active"></li>'
                        <?php
                        $getProductCategory = $catObj->getProductCategory($_GET["productID"])['categoryID'];
                        $i = 1;
                        foreach ($productsObj->getProductByCategory($getProductCategory) as $value) {
                        ?>
                            <li data-target="#carouselHome" data-slide-to="<?php echo ($i) ?>"></li>
                        <?php
                            $i++;
                        }
                        ?>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <?php
                            foreach ($productsObj->getProductByCategory($getProductCategory) as $value) {
                                $i = 0;
                            ?>
                                <div class="d-block w-100">
                                    <div class="card" style="width: 18rem; background-color:gray">
                                        <div class="card-body">
                                            Category:
                                            <h5 class="card-title"><?php echo $value['name'] ?></h5>
                                            <p class="card-text"><?php echo $value['description'] ?></p>
                                            <p class="card-text">Price:<?php echo $value['price'] ?></p>
                                            <a href="product?productID=<?php echo $value['productID'] ?>" class="btn btn-primary">View Product</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i++;
                                if ($i > 0) {
                                    break;
                                }
                            };
                            echo ('</div>');
                            $counter = false;
                            foreach ($productsObj->getProductByCategory($getProductCategory) as $value) {
                                if (!$counter) {
                                    $counter = true;
                                } else {
                                ?>
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
                            <?php
                                }
                            };
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
            <?php
            }
        }
        if (!isset($_GET['productID'])) {
            include('categories.php');
        }
            ?>
                </div>
    </div>