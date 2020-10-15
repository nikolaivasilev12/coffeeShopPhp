<?php

$cartController = new CartController();
if (isset($_SESSION["/"])) {
    $cartController->existingCart($_SESSION["cartItem"]);
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
		    unset($_SESSION["cartItem"]);
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
 <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a></div>
<?php
//Reset total cost to do recalc
if(isset($_SESSION["cartItem"])){
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
    foreach ($_SESSION["cartItem"] as $item){
        $item_price = $item["quantity"] * $item["price"];
		?>
				<tr>
				<td><strong><?php echo $item["name"]; ?></strong></td>
				<td><?php echo $item["type"]; ?></td>
				<td><?php echo $item["quantity"]; ?></td>
				<td><?php echo $item["price"]." DKK"; ?></td>
				<td><a href="index.php?action=remove&name=
                <?php echo $item["name"]; ?>" 
                class="removeBtn">Remove</a></td>
				</tr>
				<?php
        $item_total += ($item["price"]*$item["quantity"]);
		}
		?>

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
<div class="heading">Products</div>
	<?php
	$product_array = self::query("SELECT * FROM product ORDER BY productID ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=> $value){
	?>
		<div class="product-item">
        <?php echo(($product_array[$key]["name"])); ?>
			<form method="post" action="cart?action=add&name=<?php echo(trim($product_array[$key]["name"])); ?>"> 
			<div><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
			<div class="product-price"><?php echo $product_array[$key]["price"]." DKK"; ?></div>
			<div>
                <input type="text" name="quantity" value="1" size="2" />
                <input type="submit" value="Add to cart" class="addBtn" /></div>
			</form>
		</div>
	<?php
		}
	}
	?>
</body>
</html>