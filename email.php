<?php
$myMail = "ugne0051@easv365.dk";
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$msg = $_POST['message'];
$automessage = "Thanks for contacting us";
$regexp = "/^[^0-9][A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";
$regExpName = "/^[a-zA-Z]/";
$regExpMsg = "/^[a-zA-Z0-9]{3,}/";

/*if(empty($_POST['email'])) {
    header ("Location: http://localhost/phpcourse/regular_expressions/erId=3");
}*/

if (empty($name) || empty($surname) || empty($email) || empty($subject) || empty($msg)) {
    //header ("Location: http://localhost/phpcourse/regular_expressions/form.php");
    if (!empty($name)) {
        if (preg_match($regExpName, $name)) {
            echo "Name matches <br/>";
        } else {
            echo "Name has to have only letters <br/>";
        }
    } else {
        echo "Name is required <br/>";
    }
    if (!empty($surname)) {
        if (preg_match($regExpName, $surname)) {
            echo "Surname matches <br/>";
        } else {
            echo "Surname has to have only letters <br/>";
        }
    } else {
        echo "Surname is required <br/>";
    }
    if (!empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //header ("Location: http://localhost/phpcourse/regular_expressions/erId=3");
            echo "Email is invalid <br/>";
        } else {
            echo "Email is valid <br/>";
        }
    } else {
        echo "Email is required <br/>";
    }
    if (empty($subject)) {
        echo "Subject is required <br/>";
    }
    if (!empty($msg)) {
        if (preg_match($regExpMsg, $msg)) {
            echo "Message passed <br/>";
        } else {
            echo "Message has to have more than 2 characters <br/>";
        }
    } else {
        echo "Message is required <br/>";
    }
}

if (isset($_POST['submit'])) {
    $body = "$msg \n\n Name: $name \n Surname: $surname \n E-mail: $email";
    mail($myMail,$subject,$body,"From: $email\n");
    echo "Thanks for your E-mail";
}
?>


