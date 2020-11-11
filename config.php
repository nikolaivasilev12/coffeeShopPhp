<?php
require_once('vendor/autoload.php');

$stripe = [
  "secret_key"      => "sk_test_51HfoSNFLc5XDnLnpXX8fsAUZJgHeCMq9vThm92xAADaqem6lUfukdqrzYP5aQ9YQEEvFzkO6zFumbUx1O1I6LGQ100lwun9TDL",
  "publishable_key" => "pk_test_51HfoSNFLc5XDnLnp0wfRwT8vStthjSJJ20IzifkSmDTJSA3AxjfWH1REdDI8ZVZ7U1faYbKOfds8h928rKm7x67J00WeTiNqWe",
];

$captchaSecret = "6LfE8OAZAAAAAG3WPoW3pTi9zElnc3xVM_ZZsiPQ";

\Stripe\Stripe::setApiKey($stripe['secret_key']);

define('STRIPE_API_KEY', $stripe['secret_key']);  
define('STRIPE_PUBLISHABLE_KEY',  $stripe['publishable_key']);  
define('STRIPE_SUCCESS_URL', 'https://example.com/success.php'); 
define('STRIPE_CANCEL_URL', 'https://example.com/cancel.php'); 
?>