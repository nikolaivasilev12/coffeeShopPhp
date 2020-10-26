<h2>SUCESS</h2>
<?php
session_start();
if (isset($_SESSION["cart_item"])) {
    print_r($cartItem);
    $cartItem = $_SESSION['cart_item'];
} else {
    $cartItem = array();
}
if (isset($_POST['checkout'])) {
    require_once __DIR__ . '/../Controllers/Order.php';
    $orderObj = new Order();
    $orderDetails = $_POST;
    $orderData = $orderObj->saveOrder($orderDetails, $cartItem);
}