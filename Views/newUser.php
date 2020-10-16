<?php
$session = new SessionHandle();
include('header.php');
// if ($session->confirm_logged_in()) {
//     $redirect = new Redirector("login.php");
// }
// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.
    $newUser = new NewUser($_POST['user'],$_POST['pass']);
    $msg = $newUser->message;
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"/>
</head>
<?php
if (!empty($msg)) {echo "<p>" . $msg . "</p>";}
?>
<h2>Create New User</h2>
<form action="" method="post">
    Username:
    <input type="text" name="user" maxlength="30"/>
    Password:
    <input type="password" name="pass" maxlength="30"/>
    <input type="submit" name="submit" value="Create"/>
</form>
<a href="login">
    <div>
        Login Here
    </div>
</a>
</body>
</html>