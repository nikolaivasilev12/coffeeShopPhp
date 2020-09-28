<?php

require("constants.php");

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno($connection)) {
    die ("Failed to connect to MySQL: " . mysqli_connect_error());
}