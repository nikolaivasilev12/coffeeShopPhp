<?php
class LoginUser extends Controller
{
    public $message;
    public function __construct($username, $password)
    {
        $db = new DBController();
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = trim($password);
        $query = self::query("SELECT customerID, email, `password`, fname, `username` FROM customer WHERE username = '{$username}' LIMIT 1");
        $checkPermission = self::query("SELECT customerID, permissionID FROM customer_permission WHERE customerID = '{$query[0]['customerID']}'");
        $permissionName = $this->array_flatten(self::query("SELECT `name` FROM permission WHERE permissionID = '{$checkPermission[0]['permissionID']}'"));
            $found_user = $query;
            if (count($found_user)==1){
                if(password_verify($password, $found_user[0]['password'])){
                    $_SESSION['customerID'] = $found_user[0]['customerID'];
                    $_SESSION['username'] = $found_user[0]['username'];
                    $_SESSION['fname'] = $found_user[0]['fname'];
                    $_SESSION['permission'] = $permissionName['name'];
                    $redirect = new Redirector("index.php");
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