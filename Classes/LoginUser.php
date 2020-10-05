<?php
class LoginUser
{
    public $message;
    public function __construct($email, $password)
    {
        $db = new DBController();
        $email = trim($email);
        $password = trim($password);
        $query = $db->DBController->prepare("SELECT customerID, email, `password` FROM customer WHERE email = '{$email}' LIMIT 1");
        if($query->execute()){
            $found_user = $query->fetchAll();
            if (count($found_user)==1){
                echo "$password"; 
                print_r ($found_user[0]['password']);
                if(password_verify($password, $found_user[0]['password'])){
                    $_SESSION['customerID'] = $found_user[0]['customerID'];
                    $_SESSION['email'] = $found_user[0]['email'];
                    $redirect = new Redirector("frontpage.php");
                } else {
                    // username/password combo was not found in the database
                    $this->message = "Username/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.";
                }
            }else{
                $this->message = "No such Username in the database.<br />
				Please make sure your caps lock key is off and try again.";
            }
        }
    }
}