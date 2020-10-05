  
<?php
class NewUser
{
    public $message;
    public function __construct($email, $password)
    {
    // perform validations on the form data
    $db = new DBController();
    $email = trim($email);
    $password = trim($password);
    $iterations = ['cost' => 15];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);
    $query = $db->DBController->prepare("INSERT INTO `customer` (email, `password`) VALUES ('{$email}', '{$hashed_password}')");

    if ($query->execute()) {
        $this->message = "User Created.";
    } else {
        $this->message = "User could not be created.";
    }
    $db->DBClose();
}
}