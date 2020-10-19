<?php
require_once('Routes.php');

function __autoload($class_name)
{
  if (file_exists('Classes/' . $class_name . '.php')) {
    require_once 'Classes/' . $class_name . '.php';
  } else if (file_exists('Controllers/' . $class_name . '.php')) {
    require_once 'Controllers/' . $class_name . '.php';
  }
}
?>