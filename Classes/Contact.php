<?php
use Phppot\Captcha;
use Phppot\Form;

require_once "./Class/Captcha.php";
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