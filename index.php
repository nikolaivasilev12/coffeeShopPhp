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

$PageTitle = "Coffee Shop";

function customPageHeader()
{
}

?>

<body><script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>