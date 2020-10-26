<?php 
// Include configuration file   
require_once 'config.php'; 
 
$customer = \Stripe\Customer::create([
    'email' => 'customer@example.com',
    'source' => $_POST['stripeToken'],
  ]);
  
  $charge = \Stripe\Charge::create([
    'customer' => $customer->id,
    'description' => 'Custom t-shirt',
    'amount' => $order->amount,
    'currency' => 'dkk',
  ]);