<?php

namespace Phppot {

    use \Phppot\CartController;

    require_once __DIR__ . '/../Controllers/CartController.php';
    session_start();
    include('header.php');
    $cartObj = new CartController();
}

namespace {
    // if (isset($_POST['checkout-btn'])) {
    //     $order_number = rand(100, 999);
    //     $orderObj = new Order;
    //     if(isset($_SESSION["cart_item"])) {
    //         $cartItem = $_SESSION['cart_item'];
    //     } else {
    //         $cartItem = array();
    //     }
    //     $orderDetails = $_POST;
    //     $orderObj->saveOrder($orderDetails, $cartItem);
    //     $cartObj->emptyCart();
    // }
?>
    <style>
        <?php include 'style.css'; ?>
    </style>
    <HTML>

    <BODY>
        <div class="container">
            <h1>Checkout</h1>

            <form action="" method="post" onsubmit="">

                <?php if (!empty($order_number)) { ?>

                    <div class="order-message order-success">
                        You order number is <?php echo $order_number; ?>.
                        <span class="btn-message-close" onclick="this.parentElement.style.display='none';" title="Close">×</span>

                    </div>
                <?php } ?>


                <div class="row">
                    <?php require_once 'components/product-gallery.php'; ?>
                </div>
                </div>
                <?php
                require_once('payment.php')
                ?>
                <div id="shopping-cart" tabindex="1">
                    <div id="tbl-cart">
                        <div id="cart-item">
                            <?php require_once 'components/cart.php'; ?>
                        </div>
                    </div>
                </div>

                <!-- <h3>Payment details</h3> -->
                <!-- <div class="row">
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
                </div> -->

                <div class="row">
                    <div class="col">
                        <input type="hidden" class="btn btn-primary" name="customerID" value="<?php echo ($_SESSION['customerID']) ?>">
                        <!-- <input type="submit" class="btn btn-primary" name="checkout-btn" value="Checkout"> -->
                    </div>
                </div>
            </form>
        </div>
            <?php
            require_once('config.php');
            if (isset($_SESSION["cart_item"])) {
                $cartItem = $_SESSION['cart_item'];
            } else {
                $cartItem = array();
            }

            $items = array();
            foreach ($cartItem as $row => $innerArray) {
                $items[] = [
                    'name' => $innerArray['name'],
                    'amount' => $innerArray['price']*100,
                    'currency' => 'dkk',
                    'quantity' => $innerArray['quantity']
                ];
            }
            $session = \Stripe\Checkout\Session::create([
                'customer' => $_SESSION['stripeID'],
                'payment_method_types' => ['card'],
                'line_items' => [$items],
                'mode' => 'payment',
                'success_url' => 'http://localhost/coffeeShopPhp/checkout-success',
                'cancel_url' => 'http://localhost/coffeeShopPhp/checkout-fail',
              ]);
            //   print_r($session);
              if (isset($_POST['submit'])) {
                require_once __DIR__ . '/../Controllers/Order.php';
                $orderObj = new Order();
                $orderDetails = $_POST;
                $orderData = $orderObj->saveOrder($orderDetails, $cartItem);
                // print_r($_SESSION['cart_item']);
            ?>
        <script>
            (function() {
                var stripe = Stripe('<?php echo $stripe['publishable_key'] ?>');
                stripe.redirectToCheckout({
                    // Make the id field from the Checkout Session creation API response
                    // available to this file, so you can provide it as argument here
                    // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
                    sessionId: '<?php echo($session['id']); ?>'
                }).then(function (result) {
                    console.log(result);
                    // If `redirectToCheckout` fails due to a browser or network
                    // error, display the localized error message to your customer
                    // using `result.error.message`.
                });
            })();
        </script>
       <?php
        } 
        ?>
        <script>
            function checkout() {

                var valid = true;

                $("#first-name").removeClass("error-field");
                $("#email").removeClass("error-field");
                $("#shopping-cart").removeClass("error-field");
                $("#cart-error-message").hide();

                var firstName = $("#fname").val();
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
<?php
}
?>