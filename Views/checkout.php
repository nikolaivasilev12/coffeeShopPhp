<?php

namespace Phppot {

    use \Phppot\CartController;

    require_once __DIR__ . '/../Controllers/CartController.php';
    session_start();
    include('header.php');
    $cartObj = new CartController();
}

namespace {
    if ($_SESSION['permission'] !== 'customer' && $_SESSION['permission'] !== 'admin') {
        new Redirector('index');
    }
?>
    <style>
        <?php include 'style.css'; ?>
    </style>
    <html>

    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h1>Checkout</h1>
                </div>
                <form action="" method="post" onsubmit="">
                    <?php if (!empty($order_number)) { ?>

                        <div class="order-message order-success">
                            You order number is <?php echo $order_number; ?>.
                            <span class="btn-message-close" onclick="this.parentElement.style.display='none';" title="Close">×</span>

                        </div>
                    <?php
                    }
                    ?>
                    <!-- <div class="row">
                        <?php require_once 'components/product-gallery.php'; ?>
                    </div> -->
            </div>
            <div class="row">
                <div class="col-7" id="shopping-cart" tabindex="1">
                    <div class="row justify-content-center" id="tbl-cart">
                        <div class="col-12" id="cart-item">
                            <?php require_once 'components/cart.php'; ?>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="row">
                        <?php
                        require_once('payment.php')
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="hidden" class="btn btn-primary" name="customerID" value="<?php echo ($_SESSION['customerID']) ?>">
                </div>
            </div>
            </form>
        </div>
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
                'amount' => $innerArray['price'] * 100,
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
        if (isset($_POST['submit'])) {
            require_once __DIR__ . '/../Controllers/Order.php';
            $orderObj = new Order();
            $orderDetails = $_POST;
            $orderData = $orderObj->saveOrder($orderDetails, $cartItem);
        ?>
            <script>
                (function() {
                    var stripe = Stripe('<?php echo $stripe['publishable_key'] ?>');
                    stripe.redirectToCheckout({
                        sessionId: '<?php echo ($session['id']); ?>'
                    }).then(function(result) {});
                })();
            </script>
        <?php
        }
        ?>
    </body>

    </html>
<?php
}
?>