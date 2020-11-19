<?php
//look for logout keyword and log the user out if == 1
if (!isset($session)) {
    $session = new SessionHandle();
}
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $logout = new Logoutor();
    $msg = "You are now logged out.";
}elseif ($session->logged_in()) {
    $session->redirect();
}
// START FORM PROCESSING
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
                    $login = new LoginUser($_POST['username'],$_POST['password']);
                    $msg = $login->message;
                } else {
                    echo ('Your recaptcha score was not enough to verify you are human.');
                }
            } else {
                echo ('Account was not created because we failed to recieve a response from the reCaptcha server.');
            }
    }
include('header.php');
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" />
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
                        <div class="d-flex flex-column align-items-center">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label class="font-weight-bold">Username</label>
                                    <input type="username" name="username" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter Username" required>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        required>
                                </div>
                                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                                <button type="submit" name="submit" class="btn btn-primary">Login</button>
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
<script src="https://www.google.com/recaptcha/api.js?render=6LfE8OAZAAAAAPZ1kl14ai7le-A1TKo_HhyjiFmo"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('6LfE8OAZAAAAAPZ1kl14ai7le-A1TKo_HhyjiFmo', { action: 'contact' }).then(function (token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
</script>