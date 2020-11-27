<?php
require_once('Routes.php');

function myErrorHandler($errno, $errstr, $errfile, $errline) {
  echo "<b>Custom error:</b> [$errno] $errstr<br>";
  echo " Error on line $errline in $errfile<br>";
}

// Set user-defined error handler function
set_error_handler("myErrorHandler");

function __autoload($class_name)
{
  if (file_exists('Classes/' . $class_name . '.php')) {
    require_once 'Classes/' . $class_name . '.php';
  } else if (file_exists('Controllers/' . $class_name . '.php')) {
    require_once 'Controllers/' . $class_name . '.php';
  }
}
?>