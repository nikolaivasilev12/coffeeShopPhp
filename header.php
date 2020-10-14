<?php
//check of the user is logged in:
$session = new SessionHandle();
if ($session->confirm_logged_in()) {
    $redirect = new Redirector("login");
}

$PageTitle = "Coffee Shop";
?>
<!DOCTYPE html>
<html lang="en">
<header>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= isset($PageTitle) ? $PageTitle : "Default Title" ?></title>
        <!-- Additional tags here -->
    </head>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href=".">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about-us" >About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin" >Admin</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 px-4">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
            <button type="button" class="btn btn-danger"><a class="link" href="logout">Logout!</a> </button>
        </div>
    </nav>
</header>
<html>
<body>
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
<style lang="css">
.link {
    text-decoration: none !important;
    color: #ffffff !important;
}
</style>
