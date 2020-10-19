<?php
include('header.php');
// START FORM PROCESSING
if ($session->logged_in()) {
    $redirect = new Redirector("index");
}
if (isset($_POST['submit'])) { // Form has been submitted.
    $newUser = new NewUser($_POST['email'], $_POST['pass'], $_POST['username'],);
    $msg = $newUser->message;
    $redirect = new Redirector("login");
}
?>
<html>
<head>`
    <meta http-equiv="Content-Type" content="text/html"/>
</head>
<?php
if (!empty($msg)) {echo "<p>" . $msg . "</p>";}
?>

<div class="container">
    <div class="row justify-content-center">
        <h1>Create New User</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-right">
                    <form class="text-left" action="" method="post">
                            <h6>Email Address:</h6>
                            <input type="text" name="email" placeholder="Your Email" maxlength="30"/> <br><br>
                            <h6> Username:</h6>
                            <input type="text" name="username" placeholder="Your Username" maxlength="30"/> <br><br>
                            <h6>Password:</h6>
                            <input  type="password" name="pass" placeholder="Your Password" maxlength="30"/> <br> <br>
                            <div class="text-center">
                            <input class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="submit" value="Create"/> <br><br>
                            </div>
                        </form>
                            <a href="login">
                                <div>
                                    Login Here
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