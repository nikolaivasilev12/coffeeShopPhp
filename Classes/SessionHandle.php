<?php
class SessionHandle extends Controller
{
    public function __construct()
    {
        session_start();
    }

    public function logged_in() {
        return isset($_SESSION['customerID']);
    }

    public function confirm_logged_in() {
        if (!$this->logged_in()) {
            $redirect = new Redirector("login.php");
        }
    }

    public function redirect() {
        $redirect = new Redirector("index");
    }
}