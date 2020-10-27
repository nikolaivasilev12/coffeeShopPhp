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
			<button style="background-color:#6772E5;color:#FFF;padding:8px 12px;border:0;border-radius:4px;font-size:1em" id="checkout-button" role="link" name="submit" type="submit">
				Proceed to payment
			</button>
		</div>
	</div>
</div>