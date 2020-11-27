<?php
if (empty($_SESSION)) {
    $session = new SessionHandle();
}
require('cookies.php');
$PageTitle = "Coffee Shop";
?>
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
                <?php
                if (isset($_SESSION['permission'])) {
                    if ($_SESSION['permission'] === 'customer' || $_SESSION['permission'] === 'admin') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="profile">Profile</a>
                        </li>
                <?php
                    }
                }
                ?>
                <?php
                if (isset($_SESSION['permission'])) {
                    if ($_SESSION['permission'] === 'admin') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin">Admin</a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
            <?php
            if (isset($_SESSION['permission'])) { ?>
                <button type="button" class="btn btn-danger"><a class="link" href="logout">Logout!</a> </button>
            <?php
            } else { ?>
                <button type="button" class="btn btn-orange"><a class="link" href="login">Login!</a> </button>
            <?php
            }
            ?>
        </div>
    </nav>
</header>


<body>
    <script>
        var botmanWidget = {
            frameEndpoint: 'chat',
            introMessage: 'Hello, I am the all knowing coffee robot!',
            chatServer: 'botman',
            title: 'The all knowing coffee robot',
            mainColor: 'orange',
            bubbleBackground: 'orange',
            aboutText: '',
            bubbleAvatarUrl: '',
        };
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="cartJS" type="application/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <?php
    if (strpos($_SERVER['REQUEST_URI'], 'checkout') === false) {
    ?>
        <div class="row justify-content-end">
            <div class="col-6">
                <div id="b1" class="containerTab hidden" style="background:#fff;">
                    <!-- If you want the ability to close the container, add a close button -->
                    <div class="row justify-content-end">
                        <div class="col-2">
                            <button class="btn close-cart-btn ml-5 mb-3" onclick="closeCart()">
                                <span class="material-icons">
                                    highlight_off
                                </span>
                            </button>
                        </div>
                        <div class="col-12" id="shopping-cart" tabindex="1">
                            <div id="tbl-cart" class="divToScroll">
                                <div id="cart-item" class="divWithScroll">
                                    <?php require_once 'Views/components/cart.php'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="help-button-wrapper" onclick="openCart('b1')">
            <button class="help-button">
                <span class="material-icons">
                    shopping_cart
                </span>
            </button>
        </div>
    <?php
    }
    ?>
    </div>

    <script type="text/javascript">
        <?php
        include("Views/components/js/cart.js")
        ?>

        function openCart(tabName) {
            var i, x;
            x = document.getElementsByClassName("containerTab");
            var cart = document.getElementById(tabName)
            cart.style.display = "block";
        }

        function closeCart(tabName) {
            var i, x;
            x = document.getElementsByClassName("containerTab");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            var cart = document.getElementById(tabName)
            cart.style.display = "none";
        }
    </script>
</body>

<style lang="css">
    .link {
        text-decoration: none !important;
        color: #ffffff !important;
    }

    .btn-orange {
        background-color: #976C42;
        color: #FFF;
    }

    .btn-orange:hover {
        background-color: #49291F;
        color: #FFF;
    }

    .close-cart-btn {
        background-color: orange;
        color: white;
    }

    .help-button-wrapper {
        position: fixed;
        bottom: 7em;
        right: 1.2em;
        z-index: 7;
    }

    .help-button {
        height: 4.5em;
        width: 4.5em;
        font-size: 14px;
        border-radius: 50%;
        border: 0 none;
        background: orange;
        color: #fff;
        text-align: center;
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 1px 10px 0 rgba(0, 0, 0, 0.19);
    }

    .containerTab {
        position: fixed;
        bottom: 6.7em;
        right: 0.9em;
        padding: 20px;
        color: white;
        z-index: 15;
    }

    .DivToScroll {
        background-color: #F5F5F5;
        border: 1px solid #DDDDDD;
        border-radius: 4px 0 4px 0;
        color: #3B3C3E;
        font-size: 12px;
        font-weight: bold;
        left: -1px;
        padding: 10px 7px 5px;
    }

    .DivWithScroll {
        max-height: 500px;
        overflow: scroll;
        overflow-x: hidden;
    }

    .hidden {
        display: none;
    }
</style>