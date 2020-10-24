<?php

namespace Phppot;

class CartController
{
    public $cartSessionItemCount = 0;
    function __construct()
    {
        if (!empty($_SESSION["cart_item"]) && is_array($_SESSION["cart_item"])) {
            $this->cartSessionItemCount = count($_SESSION["cart_item"]);
        }
    }

    function addToCart()
    {
        if (isset($_POST)) {
            $productCode = $_POST["code"];
            $productTitle = $_POST["productTitle"];
            $poductQuantity = 1;
            $productPrice = $_POST["productPrice"];
            $inStock = $_POST["inStock"];
        }

        $cartItem = array(
            'code' => $productCode,
            'name' => $productTitle,
            'quantity' => $poductQuantity,
            'price' => $productPrice,
            'inStock' => $inStock,
            'total' => $poductQuantity * $productPrice
        );


        if (!empty($_SESSION["cart_item"])) {
            foreach ($_SESSION["cart_item"] as $k => $v) {
                echo ('</br>');
                if ($_SESSION["cart_item"][$k]['code'] == $cartItem['code'] && $_SESSION["cart_item"][$k]['quantity'] < $_SESSION["cart_item"][$k]['inStock']) {
                    return $_SESSION["cart_item"][$k]['quantity']++;
                }
            }
        }
        $_SESSION["cart_item"][$productCode] = $cartItem;
        if (!empty($_SESSION["cart_item"]) && is_array($_SESSION["cart_item"])) {
            $this->cartSessionItemCount = count($_SESSION["cart_item"]);
        }
    }

    function editCart()
    {
        if (!empty($_SESSION["cart_item"])) {
            $total_price = 0;
            foreach ($_SESSION["cart_item"] as $k => $v) {
                if ($_POST["code"] == $k && $_SESSION["cart_item"][$k]['quantity'] < $_SESSION["cart_item"][$k]['inStock']) {
                    $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                } elseif ($_POST["code"] == $k && $_POST["quantity"] <= $_SESSION["cart_item"][$k]["inStock"]) {
                    $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                }
                $total_price = $total_price + ($_SESSION["cart_item"][$k]["quantity"] * $_SESSION["cart_item"][$k]["price"]);
            }
            return $total_price;
        }

        if (!empty($_SESSION["cart_item"]) && is_array($_SESSION["cart_item"])) {
            $this->cartSessionItemCount = count($_SESSION["cart_item"]);
        }
    }

    function removeFromCart()
    {
        if (!empty($_SESSION["cart_item"])) {
            foreach ($_SESSION["cart_item"] as $k => $v) {
                if ($_POST["code"] == $k)
                    unset($_SESSION["cart_item"][$k]);
                if (empty($_SESSION["cart_item"]))
                    unset($_SESSION["cart_item"]);
            }
        }

        if (!empty($_SESSION["cart_item"]) && is_array($_SESSION["cart_item"])) {
            $this->cartSessionItemCount = count($_SESSION["cart_item"]);
        }
    }

    function emptyCart()
    {
        unset($_SESSION["cart_item"]);
        $this->cartSessionItemCount = 0;
    }
}
