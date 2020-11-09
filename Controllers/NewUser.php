
<?php
class NewUser extends Controller
{
    public $message;
    public function __construct($email, $password, $username)
    {
        // perform validations on the form data and Sanitizing
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = trim($password);
        $iterations = ['cost' => 15];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

        // Create customer
        require_once('config.php');
        $customer = \Stripe\Customer::create([
            'email' => $email
        ]);
        $customerParams = array($email, $username, $hashed_password, $customer['id']);
        self::query("INSERT INTO `customer` (email, `username`, `password`, `stripeID`) VALUES ( ? , ? , ? , ?)", $customerParams);

        // // Select customerID
        // $customerID = $this->array_flatten(self::query("SELECT customerID FROM `customer` ORDER BY customerID DESC LIMIT 1"));

        // // Add customer permission
        // self::query("INSERT INTO `customer_permission` (customerID, permissionID) VALUES ( ? , 1)", array($customerID['customerID']));
    }
}
