<!-- <form action="charge.php" method="post">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="<?php echo $stripe['publishable_key']; ?>"
          data-description="Access for a year"
          data-amount="5000"
          data-locale="auto"></script>
          
</form> -->
<!-- <form action="charge.php" method="POST">
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $stripe['publishable_key']; ?>" data-name="Custom t-shirt" data-description="Your custom designed t-shirt" data-amount="5000" data-currency="dkk">
    </script>
</form> -->

<head>
    <title>Buy cool new product</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <form action="" method="post">
        <button name="checkout" class="btn btn-primary" id="checkout-button">
            Checkout
        </button>
    </form>
    <script>
        // var stripe = Stripe('pk_test_51HfoSNFLc5XDnLnp0wfRwT8vStthjSJJ20IzifkSmDTJSA3AxjfWH1REdDI8ZVZ7U1faYbKOfds8h928rKm7x67J00WeTiNqWe');

        // var checkoutButton = document.getElementById('checkout-button');

        // checkoutButton.addEventListener('click', function() {
        //     stripe.redirectToCheckout({
        //         lineItems: [{
        //         // Define the product and price in the Dashboard first, and use the price
        //         // ID in your client-side code.
        //         price: '{PRICE_ID}',
        //         quantity: 1
        //         }],
        //         mode: 'payment',
        //         successUrl: 'https://www.example.com/success',
        //         cancelUrl: 'https://www.example.com/cancel'
        //     });
        // });
    </script>
</body>