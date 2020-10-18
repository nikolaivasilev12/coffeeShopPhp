<?php
namespace Phppot;
use \Phppot\CartController;
require_once __DIR__ . '/../../Controllers/CartController.php';
$cartModel = new CartController();
session_start();

if (! empty($_POST["action"])) {
    switch ($_POST["action"]) {
        case "add":
            $cartModel->addToCart();
            break;
        case "edit":
            $totalPrice = $cartModel->editCart();
            print $totalPrice;
            exit;
            break;
        case "remove":
            $cartModel->removeFromCart();
            break;
        case "empty":
            $cartModel->emptyCart();
            break;
    }
}
require_once 'cart.php';