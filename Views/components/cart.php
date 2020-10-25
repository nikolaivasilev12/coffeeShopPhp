<?php

use Phppot\CartController;

require_once('Controllers/CartController.php');
$cartModel = new CartController();
?>
<input type="hidden" id="cart-item-count" value="<?php echo $cartModel->cartSessionItemCount; ?>">
<?php
if ($cartModel->cartSessionItemCount > 0) {
?>
	<div id="txt-heading">
		<h2>Your Shopping Cart</h2>
		<div id="close"></div>
	</div>
	<table width="100%" id="cart-table" cellpadding="10" cellspacing="1" border="0">
		<tbody>
			<tr>
				<th>Name</th>
				<th>Quantity</th>
				<th class="text-right">Price</th>
				<th class="text-right">Action</th>
			</tr>
			<?php
			$item_total = 0;
			$i = 1;
			foreach ($_SESSION["cart_item"] as $item) {
			?>
				<tr>
					<td><?php echo $item["name"]; ?></td>
					<td><input type="number" name="quantity" class="quantity" value="<?php echo $item['quantity']; ?>" data-code='<?php echo $item["code"]; ?>' size=2 onChange="updatePrice(this)" /> <input type="hidden" class='total' name="total" value="<?php echo $item["price"]; ?>" /></td>
					<td class="prc text-right" id="price" <?php echo $i; ?>><?php echo $item["price"]; ?></td>
					<?php $i++; ?>
					<td class="text-right"><a onClick="cartAction('remove','<?php echo $item["code"]; ?>')" class="btn btn-secondary">Remove Item</a></td>
				</tr>
			<?php
				$item_total += ($item["price"] * $item['quantity']);
			}
			?>
			<tr id="tot">
				<td class="text-right" colspan="3">
					<strong>
						Total (USD):
					</strong>
					<span id="total"><?php echo $item_total; ?></span>
				</td>
				<td class="text-right">
					<a id="btnEmpty" class="btn btn-danger" onClick="cartAction('empty', '');">
						Empty Cart
					</a>
					<?php
					if (isset($_SESSION['permission']) && $_GET['url'] != 'checkout') {
					?>
						<a href="checkout" class="btn btn-primary">
							Checkout
						</a>
					<?php
					} elseif ($_GET['url'] !== 'checkout') {
					?>
						<p class="text-danger h5">
							You need an account to complete your order!
						</p>
					<?php
					}
					?>
				</td>
			</tr>
		</tbody>
	</table>
<?php
} else {
?>
	<h2 id="empty-cart">Your cart is empty</h2>
<?php
}
?>