<?php

class Order extends Controller {

    function saveOrder($order, $cartItem) {
        
        self::query("INSERT INTO `order` (customerID, adressID) VALUES ('{$order['customerID']}', 1)");
        $orderID = self::query("SELECT * FROM `order` ORDER BY orderID DESC LIMIT 1");
        foreach($cartItem as $row => $innerArray) {
            self::query("INSERT INTO `orderhasproduct` (price, `productID`, `amount`, `orderID`) 
            VALUES ('{$innerArray['price']}', '{$innerArray['code']}', '{$innerArray['quantity']}', '{$orderID[0]['orderID']}');");
            print_r($innerArray); echo "<br/>";
            print_r($orderID[0]['orderID']); echo "<br/>";
        };
        echo ('<br/>');
        // print_r($cartItem);
    }
}

?>