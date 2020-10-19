
<?php
class NewUser extends Controller
{
    public $message;
    public function __construct($email, $password, $username)
    {
        // perform validations on the form data
        $email = trim($email);
        $username = trim($username);
        $password = trim($password);
        $iterations = ['cost' => 15];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

        // Create customer
        self::query("INSERT INTO `customer` (email, `username`, `password`) VALUES ('{$email}', '{$username}', '{$hashed_password}');");

        // Select customerID
        $customerID = $this->array_flatten(self::query("SELECT customerID FROM `customer` ORDER BY customerID DESC LIMIT 1"));

        // Add customer permission
        self::query("INSERT INTO `customer_permission` (customerID, permissionID) VALUES ('{$customerID['customerID']}', 1)");
    }
}
