<?php
/*spl_autoload_register(function ($class)
{include"classes/".$class.".php";});
//check of the user is logged in:
$session = new SessionHandle();
if ($session->confirm_logged_in()) {
    $redirect = new Redirector("login.php");
}*/
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"/>
</head>
<body>
<h1 align="center">Welcome to the backend <?php echo $_SESSION['user']; ?></h1>
<p align="center"><a href="login.php?logout=1">Logout!</a> </p>
</body>
</html>