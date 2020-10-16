<?php
//check of the user is logged in:
if (isset($_SESSION['permission'])) {
    if ($_SESSION['permission'] === 'admin') {
        include('_partials/headerAdmin.php');
        if ($session->confirm_logged_in()) {
            $redirect = new Redirector("login");
        }
    } elseif ($_SESSION['permission'] === 'customer'){
        include('_partials/headerDefault.php');
        if ($session->confirm_logged_in()) {
            $redirect = new Redirector("login");
        }
    }
} else {
    include('_partials/headerLoggedOut.php');
}
?>