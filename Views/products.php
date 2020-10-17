<?php
include('header.php');
$productsObj = new Products();
if (isset($_GET["productID"])) {
    $productDetails = $productsObj->getProductDetails($_GET["productID"]);
}

?>
<style> <?php include 'style.css'; ?> </style>
<div class="container">
    <div class="row justify-content-center">
        <?php if (!isset($_GET["productID"])) {
            $cartController = new CartController();
            if (isset($_SESSION['/'])) {
                $cartController->existingCart($_SESSION["cart_item"]);
            }
            if(!empty($_GET["action"])) {
                if (isset($_GET['name'])){
                    $name = $_GET['name'];}
            
                //start the switch/case
                switch($_GET["action"]) {
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
                        }else {
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
            
            
            <html>
            <head>
            <title>Shopping Cart</title>
            <link href="style.css" type="text/css" rel="stylesheet" />
            </head>
            <body>
            <div id="shopping-cart">
            <div class="heading">Shopping Cart
            </div>
            <?php
            //Reset total cost to do recalc
            if(isset($_SESSION["cart_item"])){
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
                foreach ($_SESSION["cart_item"] as $item){
                    $item_price = $item["quantity"] * $item["price"];
                    ?>
                            <tr>
                            <td><strong><?php echo $item["name"]; ?></strong></td>
                            <td><?php echo $item["type"]; ?></td>
                            <td><?php echo $item["quantity"]; ?></td>
                            <td><?php echo $item["price"]." DKK"; ?></td>
                            <td><a href="product?action=remove&name=<?php echo $item["name"]; ?>" 
                            class="removeBtn">Remove</a>
                            </td>
                            </tr>
                           
                            <?php
                    $item_total += ($item["price"]*$item["quantity"]);
                    }
                    ?>
                <!--  Empty cart -->
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><a id="btnEmpty" href="product?action=empty">Empty Cart</a></td>
                        </tr>
                <!-- Empty cart END -->
            
            <tr>
            <td colspan="5" align=right><strong>Total:</strong> <?php echo $item_total." DKK"; ?></td>
            </tr>
            </tbody>
            </table>		
              <?php
            } else{
                ?>
                <div class="no-records">Your cart is Empty</div>
                <?php
            }
            ?>
            </div>
            <div class="col-12 text-center heading">Products</div>
                <?php
                $product_array = self::query("SELECT * FROM product ORDER BY productID ASC");
                if (!empty($product_array)) { 
                    foreach($product_array as $key=> $value){
                ?>
                    <div class="product-item">
                    <?php echo(($product_array[$key]["name"])); ?>
                        <form method="post" action="product?action=add&name=<?php echo(trim($product_array[$key]["name"])); ?>"> 
                        <div><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
                        <div class="product-price"><?php echo $product_array[$key]["price"]." DKK"; ?></div>
                        <div>
                            <input type="text" name="quantity" value="1" size="2" />
                            <input type="submit" value="Add to cart" class="addBtn" />
                            <?php echo $product_array[$key]['productID']?>
                            <a href="product?productID=<?php echo($product_array[$key]['productID']) ?>" class="btn btn-primary">View Product</a></div>
                        </form>
                    </div>
                <?php
                    }
                }
  
           
        } else {
            
            echo ('
    <div class="col-12 text-center">
        <h1> All Products </h1>
    </div>
    ');
              echo ('
                <div class="col-12 text-center">
                    <h1>Product Name: <span class="text-color-red">' . $productDetails["name"] . '</span></h1>
                </div>
                <div class="col-12">
                    <p> <strong>Product Description:</strong>' . $productDetails["description"] . '</p>
                </div>    
                <div class="col-12">
                    <p> <strong>Price:</strong>' . $productDetails["price"] . ' EUR</p>
                </div>
                <div class="col-12">
                    <p> <strong>Origin:</strong>' . $productDetails["origin"] . '</p>
                </div>
                <div class="col-12">
                    <p> <strong>Type:</strong>' . $productDetails["type"] . '</p>
                </div>
                <div class="col-12">
                <p> <strong>Stock:</strong>' . $productDetails["stock"] . '</p>
                </div> 
                <div class="col-12">
                <a href="cart.php'. '" class="btn btn-primary">Add to Shopping Cart</a>
                <input type="submit" value="Add to Cart" class="addBtn" />
                </div> 
                
               
            ');
            
            $catObj = new Categories();
            if($catObj->getProductCategory($_GET["productID"])){
                echo('
                    <div class="col-12 text-center">
                        <h3>More products from the same category</h3>
                    </div>
                ');
                $getProductCategory = $catObj->getProductCategory($_GET["productID"])['categoryID'];
                echo('
                <div id="carouselHome" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselHome" data-slide-to="0" class="active"></li>');
                $i = 1;
                foreach ($productsObj->getProductByCategory($getProductCategory) as $value) {
                    echo ('<li data-target="#carouselHome" data-slide-to="' . $i . '"></li>');
                    $i++;
                }
                echo('</ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">');
                    foreach ($productsObj->getProductByCategory($getProductCategory) as $value) {
                        $i = 0;
                        echo ('
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
                        ');
                        $i++;
                        if ($i > 0) {
                            break;
                        }
                    };
                echo('</div>');
                $counter = false;
                foreach ($productsObj->getProductByCategory($getProductCategory) as $value) {
                    if (!$counter) {
                        $counter = true;
                    } else {
                        echo ('
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
                        ');
                    }
                };
                echo ('
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
            ');
            }

        }
        ?>
    </div>
</div>
