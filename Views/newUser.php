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
elseif (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
?>
<html>

<head>`
    <meta http-equiv="Content-Type" content="text/html" />
</head>
<?php
if (!empty($email)) {echo "<p>" . $msg . "</p>";}
?>

<div class="container">
    <div class="row justify-content-center">
        <h1>Create New User</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <form action="" method="post">
                            <div class="form-group">
                                <label class="font-weight-bold" for="exampleInputEmail1">Email Address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Enter Email" required>
                                <label class="font-weight-bold">Username</label>
                                <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter Username" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Password</label>
                                <input type="password" name="pass" class="form-control" required
                                    placeholder="Enter Password">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Create</button>
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

<script>

</script>

<?php
/* Kim's regexp */
$regExp = "/^[A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_-]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";

?>