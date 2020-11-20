<?php
use Phppot\Captcha;
use Phppot\Contact;

require_once "./Classes/Captcha.php";
$captcha = new Captcha();
if (count($_POST) > 0) {
    $userCaptcha = filter_var($_POST["captcha_code"], FILTER_SANITIZE_STRING);
    $isValidCaptcha = $captcha->validateCaptcha($userCaptcha);
    if ($isValidCaptcha) {
        
        $userName = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
        $userEmail = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
        $subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
        $content = filter_var($_POST["content"], FILTER_SANITIZE_STRING);
        
        require_once "/Contact.php";
        $contact = new Contact();
        $insertId = $contact->addToContacts($userName, $userEmail, $subject, $content);
        if (! empty($insertId)) {
            $success_message = "Your message received successfully";
        }
    } else {
        $error_message = "Incorrect Captcha Code";
    }
}
?>
<html>
<body>
    <form name="frmContact" method="post" action="">
        <table border="0" cellpadding="10" cellspacing="1" width="40%"
            class="demo-table">
            <tr class="tablerow">
                <td width="50%">Name<br /> <input type="text"
                    name="userName" class="demo-input" required></td>
                <td width="50%">Email<br /> <input type="email"
                    name="userEmail" class="demo-input" required></td>
            </tr>
            <tr class="tablerow">
                <td colspan="2">Subject<br /> <input type="text"
                    name="subject" class="demo-input" required></td>
            </tr>
            <tr class="tablerow">
                <td colspan="2">Content<br /> <textarea name="content"
                        class="demo-input" rows="5" required></textarea></td>
            </tr>
            <tr class="tablerow">
                <td>Captcha Code: <span id="error-captcha"
                    class="demo-error"><?php if(isset($error_message)) { echo $error_message; } ?></span>
                    <input name="captcha_code" type="text"
                    class="demo-input captcha-input">
                </td>
                <td><br /> <input type="submit" name="submit"
                    value="Submit" class="demo-btn"></td>
            </tr>
        </table>
<?php if(isset($success_message)) { ?>
<div class="demo-success"><?php echo $success_message; ?></div>
<?php } ?>
</form>
</body>
</html>

<style>
</style>