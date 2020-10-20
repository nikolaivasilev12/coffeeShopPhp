<?php

class Order extends Controller
{

    function saveOrder($order, $cartItem)
    {

        self::query("INSERT INTO `order` (customerID) VALUES ('{$order['customerID']}')");
        $orderID = self::query("SELECT * FROM `order` ORDER BY orderID DESC LIMIT 1");

        foreach ($cartItem as $row => $innerArray) {
            self::query("INSERT INTO `orderhasproduct` (price, `productID`, `amount`, `orderID`) 
            VALUES ('{$innerArray['price']}', '{$innerArray['code']}', '{$innerArray['quantity']}', '{$orderID[0]['orderID']}');");
        };

        $postalCodeExists = self::query("SELECT 1 FROM postalcode WHERE postalCode = '{$order['zipcode']}'");

        if (!!$postalCodeExists !== true) {
            self::query("INSERT INTO postalcode (postalCode, city) VALUES ('{$order['zipcode']}', '{$order['city']}')");
        }
        self::query("INSERT INTO adress (street, postalCode) VALUES ('{$order['adress']}', '{$order['zipcode']}')");
    }
}
