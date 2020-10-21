<?php

class Order extends Controller
{

    function saveOrder($order, $cartItem)
    {

        self::query("INSERT INTO `order` (customerID) VALUES ( ? ) ", array($order['customerID']));
        $orderID = self::query("SELECT * FROM `order` ORDER BY orderID DESC LIMIT 1");

        foreach ($cartItem as $row => $innerArray) {
            $orderHasProductParams = array($innerArray['price'], $innerArray['code'], $innerArray['quantity'], $orderID[0]['orderID']);
            self::query("INSERT INTO `orderhasproduct` (price, `productID`, `amount`, `orderID`) 
            VALUES ( ? , ? , ? , ? )", $orderHasProductParams);
        };
        
        $postalCodeExists = self::query("SELECT 1 FROM postalcode WHERE postalCode = ? ", array($order['zipcode']));
        
        if (!!$postalCodeExists !== true) {
            $postalCodeParams = array($order['zipcode'], $order['city']);
            self::query("INSERT INTO postalcode (postalCode, city) VALUES ( ? , ? )", $postalCodeParams);
        }
        $adressParams = array($order['adress'], $order['zipcode']);
        self::query("INSERT INTO adress (street, postalCode) VALUES ( ? , ? )", $adressParams);
        
        $getLastAddress = $this->array_flatten(self::query("SELECT * FROM adress ORDER BY adressID DESC LIMIT 1"));
        self::query("UPDATE `order` SET adressID = ? WHERE orderID = ?", array($getLastAddress['adressID'], $orderID[0]['orderID']));
    }
}
