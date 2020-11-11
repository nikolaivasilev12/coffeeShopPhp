<?php
include('header.php');
// START FORM PROCESSING
if ($session->logged_in()) {
    $redirect = new Redirector("index");
}
if (isset($_POST['submit']) && isset($_POST['recaptcha_response'])) { // Form has been submitted.
    require_once('config.php');
            // Build POST request:
            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = $captchaSecret;
            $recaptcha_response = $_POST['recaptcha_response'];
        
            // Make and decode POST request:
            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);
        
            if (!empty($recaptcha->score)) {
                // Take action based on the score returned:
                if ($recaptcha->score >= 0.5) {
                    // Verified!
                    require_once('Classes/Redirector.php');
                    $newUser = new NewUser($_POST['email'], $_POST['pass'], $_POST['username'],);
                    $msg = $newUser->message;
                    $redirect = new Redirector("login");
                } else {
                    echo ('Your recaptcha score was not enough to verify you are human.');
                }
            } else {
                echo ('Account was not created because we failed to recieve a response from the reCaptcha server.');
            }
    }
        

/* This might not be working - check later */
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

<head>
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
                            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
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
<script src="https://www.google.com/recaptcha/api.js?render=6LfE8OAZAAAAAPZ1kl14ai7le-A1TKo_HhyjiFmo"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6LfE8OAZAAAAAPZ1kl14ai7le-A1TKo_HhyjiFmo', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>
<?php
/* Kim's regexp */
$regExp = "/^[A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_-]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";

?>