<?php
spl_autoload_register(function ($class)
{include"classes/".$class.".php";});
$session = new SessionHandle();
//look for logout keyword and log the user out if == 1
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $logout = new Logoutor();
    $msg = "You are now logged out.";
}elseif ($session->logged_in()) {
    $redirect = new Redirector("index.php");
}
// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.
    $login = new LoginUser($_POST['email'],$_POST['password']);
    $msg = $login->message;
}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"/>
</head>
<body>

<?php
if (!empty($msg)) {echo "<p>" . $msg . "</p>";}
?>

<h2>Please login</h2>
<form action="" method="post">
    Email:
    <input type="text" name="email" maxlength="30"/>
    Password:
    <input type="password" name="password" maxlength="30"/>
    <input type="submit" name="submit" value="Login"/>
</form>
</body>
</html>
