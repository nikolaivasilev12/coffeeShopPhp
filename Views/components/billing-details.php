<?php

if ($_SESSION["cart_item"]) {
	$txt = 'You have ordered these items: ';
	foreach (($_SESSION["cart_item"]) as $key => $cart_item) {
		$txt .= $cart_item['quantity'] . ' ' . "units" . " ". "of" . " ". $cart_item['name'] . ' ' . "for" . ' ' . $cart_item['price'] . " " . "DKK" . ",";
	}
}


if (isset($_POST['submit'])) {
$to = $_POST['email'];
$subject = "You have successfully bought items!";

mail($to,$subject,$txt);
}


?>

<div class="col">
	<div class="row justify-content-center">
		<h3>
			Billing details
		</h3>
	</div>
	<div class="row justify-content-center">
		<div class="col-2">
			First Name <span class="required error"></span>
		</div>
		<div class="col-4">
			<div id="first-name-info"></div>
			<input class="input-box-330" type="text" name="fame" id="fname">
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-2">
			Last Name <span class="required error"></span>
		</div>
		<div class="col-4">
			<div id="first-name-info"></div>
			<input class="input-box-330" type="text" name="lame" id="lname">
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-2">Address</div>
		<div class="col-4">
			<input class="input-box-330" class="input-box-330" type="text" name="adress">
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-2">City</div>
		<div class="col-4">
			<input class="input-box-330" type="text" name="city">
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-2">Zipcode</div>
		<div class="col-4">
			<input class="input-box-330" type="text" name="zipcode">
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-2">
			Email<span class="required error"></span>
		</div>
		<div class="col-4">
			<div id="email-info"></div>
			<input class="input-box-330" type="text" name="email" id="email">
		</div>
		<input type="hidden" class="btn btn-primary" name="customerID" value="<?php echo ($_SESSION['customerID']) ?>">
	</div>
	<div class="row justify-content-center">
		<div class="col">
			<button class="btn btn-primary my-3" id="checkout-button" role="link" name="submit" type="submit">
				Proceed to payment
			</button>
		</div>
	</div>
</div>