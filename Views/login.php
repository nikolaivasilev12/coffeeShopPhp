<?php
spl_autoload_register(function ($class)
{include"classes/".$class.".php";});
$session = new SessionHandle();
include('header.php');
//look for logout keyword and log the user out if == 1
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $logout = new Logoutor();
    $msg = "You are now logged out.";
}elseif ($session->logged_in()) {
    $redirect = new Redirector("index");
}
// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.
    $login = new LoginUser($_POST['username'],$_POST['password']);
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
<div class="container">
    <div class="row justify-content-center">
        <h1>Log In</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-right">
                        <form class="text-left" action="" method="post">
                            <h6>Username:</h6>
                            <input type="text" name="username" placeholder="Your Username" maxlength="30"/> <br><br>
                            <h6>Password:</h6>
                            <input type="password" name="password" placeholder="Your Password" maxlength="30"/> <br> <br>
                            <div class="text-center">
                            <input class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="submit" value="Login"/> <br><br>
                            </div>
                        </form>
                    <a href="new-user">
                    <div>
                        Create a new account
                    </div>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

