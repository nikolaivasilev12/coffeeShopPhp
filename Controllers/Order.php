<?php

class Order extends Controller
{

    function saveOrder($order, $cartItem)
    {
        $currentDateTime = new DateTime();
        self::query("INSERT INTO `order` (customerID, `date`) VALUES ( ? , ? ) ", array($order['customerID'], $currentDateTime->format('Y-m-d H:i:s')));
        $orderID = self::query("SELECT * FROM `order` ORDER BY orderID DESC LIMIT 1");
        foreach ($cartItem as $row => $innerArray) {
            $orderHasProductParams = array($innerArray['price'], $innerArray['code'], $innerArray['quantity'], $orderID[0]['orderID']);
            self::query("INSERT INTO `orderhasproduct` (price, `productID`, `amount`, `orderID`) 
            VALUES ( ? , ? , ? , ? )", $orderHasProductParams);
            $productLeftInStock = $innerArray['inStock'] - $innerArray['quantity'];
            $productLeftInStockParams = array($productLeftInStock, $innerArray['code']);
            self::query("UPDATE `product` SET stock = ? WHERE productID = ?", $productLeftInStockParams);
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

    public static function stripeCheckout($orderDetails, $cartItem) {
        require_once('config.php');
        // \Stripe\Stripe::setApiKey($stripe['secret_key']);
        // $stripe = new \Stripe\StripeClient($stripe['secret_key']);
        foreach ($cartItem as $row => $innerArray) {
            print_r($innerArray);
            echo("</br>");
            $product = \Stripe\Product::create([
                'id' => $innerArray['code'],
                'name' => $innerArray['name']
            ]);
            $price = \Stripe\Price::create([
                'product' => $innerArray['code'],
                'unit_amount' => intval($innerArray['price']),
                'currency' => 'dkk',
            ]);
        }
        $customer = \Stripe\Customer::create([
            'email' => 'jenny.rosen@example.com',
            'payment_method' => 'pm_card_visa',
            'invoice_settings' => [
                'default_payment_method' => 'pm_card_visa',
            ],
        ]);
        $session = \Stripe\Checkout\Session::create([
            'customer' => 'cus_IH5oxB4VQFYOXD',
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => 'price_1HgXb3FLc5XDnLnpSefhMhOp',
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'https://example.com/success',
            'cancel_url' => 'https://example.com/cancel',
            ]);
    }
}
