<?php
require_once('Routes.php');

function handleError($errno, $errstr,$error_file,$error_line) {
  echo "<b>Error:</b> [$errno] $errstr - $error_file:$error_line";
  echo "<br />";
  echo "Terminating PHP Script";
  
  die();
}

// Set user-defined error handler function
set_error_handler("handleError");

function __autoload($class_name)
{
  if (file_exists('Classes/' . $class_name . '.php')) {
    require_once 'Classes/' . $class_name . '.php';
  } else if (file_exists('Controllers/' . $class_name . '.php')) {
    require_once 'Controllers/' . $class_name . '.php';
  }
}
?>