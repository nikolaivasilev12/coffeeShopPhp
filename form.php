<?php
if(isset($_GET['erId'])){
    if ($_GET['erId']==3) {
        echo "Wrong Email";
    }}


?>
<html>
<head>
    <title>Contact form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<div class="contact-title">
    <h1>Contact Us</h1>
</div>

<div class="contact-form">
    <form id="contact-form" method="post" action="email.php"><br><br>
        <input type ="text" class="form-control" placeholder="Your Name" name="name"><br><br>
        <input type ="text" class="form-control" placeholder="Your Surname" name="surname"><br><br>
        <input type ="text" class="form-control" placeholder="Your Email" name="email"><br><br>
        <input type ="text" class="form-control" placeholder="Subject" name="subject"><br><br>
        <textarea name="message" class="form-control-message" placeholder="Message"></textarea><br><br>
        <input class="submit" type="submit" id="submit" name="submit" value="Send">

    </form>
</div>
</body>
</html>








