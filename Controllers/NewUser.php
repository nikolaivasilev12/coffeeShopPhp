  
<?php
class NewUser extends Controller
{
    public $message;
    public function __construct($email, $password)
    {
        // perform validations on the form data
        $email = trim($email);
        $password = trim($password);
        $iterations = ['cost' => 15];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);
        $productsId = (self::query("INSERT INTO `customer` (email, `password`) VALUES ('{$email}', '{$hashed_password}')"));
        echo ('GJ but this is static');
    }
}
