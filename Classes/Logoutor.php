<?php
class Logoutor extends Controller
{
    public function __construct()
    {
    session_start();
    // Four steps to closing a session
    // (i.e. logging out)

    // 1. Find the session
    // This is done with session_start()
    // in the session handle class

    // 2. Unset all the session variables
    $_SESSION = array();

    // 3. Destroy the session cookie
    if(isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }

    // 4. Destroy the session
    session_destroy();
    }
} 