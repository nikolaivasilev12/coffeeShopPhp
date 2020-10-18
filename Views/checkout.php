<?php
session_start();
include('header.php');
if (isset($_POST["checkout-btn"])) {
    $order_number = rand(100, 999);
}
?>
<style>
    <?php include 'style.css'; ?>
</style>
<HTML>
<BODY>
    <div class="container">
        <h1>Checkout</h1>

        <form action="" method="post" onsubmit="return checkout()">

            <?php if (!empty($order_number)) { ?>

                <div class="order-message order-success">
                    You order number is <?php echo $order_number; ?>.
                    <span class="btn-message-close" onclick="this.parentElement.style.display='none';" title="Close">×</span>

                </div>
            <?php } ?>


            <div class="row">
                <?php require_once 'components/product-gallery.php'; ?>
            </div>
            <div class="row justify-content-center my-5">
                <?php require_once 'components/billing-details.php'; ?>
            </div>

            <!-- <div class="cart-error-message" id="cart-error-message">Cart
                must not be emty to checkout</div> -->
            <div id="shopping-cart" tabindex="1">
                <div id="tbl-cart">
                    <div id="txt-heading">
                        <h2>Your Shopping Cart</h2>
                        <div id="close"></div>
                    </div>
                    <div id="cart-item">
                        <?php require_once 'components/cart.php'; ?>
                    </div>
                </div>
            </div>

                <h3>Payment details</h3>
                <div class="row">
                        <div class="col-12">
                            <input class="bank-transfer" type="radio" checked="checked" value="Direct bank transfer" name="direct-bank-transfer">
                            <span>
                                Direct bank transfer
                            </span>
                        </div>

                        <div class="col">Specify your order
                            number when you make the bank transfer. Your
                            order will be shippied after the amount is
                            credited to us.</div>
                </div>

            <div class="row">
                <div class="col">
                    <input type="submit" class="btn btn-primary"value="Checkout">
                </div>
            </div>
        </form>
    </div>
    <script src="cartJS"></script>
    <script>
        function checkout() {

            var valid = true;

            $("#first-name").removeClass("error-field");
            $("#email").removeClass("error-field");
            $("#shopping-cart").removeClass("error-field");
            $("#cart-error-message").hide();

            var firstName = $("#first-name").val();
            var cartItem = $("#cart-item-count").val();
            var email = $("#email").val();
            var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

            $("#first-name-info").html("").hide();
            $("#email-info").html("").hide();

            if (firstName.trim() == "") {
                $("#first-name-info").html("required.").css("color", "#ee0000").show();
                $("#first-name").addClass("error-field");
                valid = false;
            }
            if (email == "") {
                $("#email-info").html("required").css("color", "#ee0000").show();
                $("#email").addClass("error-field");
                valid = false;
            } else if (email.trim() == "") {
                $("#email-info").html("Invalid email address.").css("color", "#ee0000").show();
                $("#email").addClass("error-field");
                valid = false;
            } else if (!emailRegex.test(email)) {
                $("#email-info").html("Invalid email address.").css("color", "#ee0000")
                    .show();
                $("#email").addClass("error-field");
                valid = false;
            }
            if (cartItem == 0) {
                $("#cart-error-message").show();
                $("#shopping-cart").addClass("error-field");
                valid = false;
            }
            if (valid == false) {
                $('.error-field').first().focus();
                valid = false;
            }
            return valid;
        }
    </script>
</BODY>

</HTML>