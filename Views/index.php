<?php
if (isset($_POST['submit']) && isset($_POST['recaptcha_response'])) { // Form has been submitted.
    require_once('config.php');
            // Build POST request:
            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = $captchaSecret;
            $recaptcha_response = $_POST['recaptcha_response'];
            // Make and decode POST request:
            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);

            if (!empty($recaptcha->score)) {
                // Take action based on the score returned:
                if ($recaptcha->score >= 0.5) {
                    // Verified!
                    $to = "NikolaiVasilev208@gmail.com";
                    $subject = $_POST['subject'];
                    $txt = 'You have recieved an email from' . $_POST['user_email'] . '</br>' . 'The message was: ' . $_POST['content'];

                    mail($to,$subject,$txt);
                    include ('Classes/Redirector.php');
                    new Redirector('index');

                } else {
                    echo ('Your recaptcha score was not enough to verify you are human.');
                }
            } else {
                echo ('Your message was not sent because we failed to recieve a response from the reCaptcha server.');
            }
    }
include("Views/_partials/header.php");
$index = new Index();
?>

<!-- CART -->
<!-- <div class="col-12">
        <div class="row justify-content-end">
            <div class="col-5" id="shopping-cart" tabindex="1" style="border: solid 1px orange;">
                <div id="tbl-cart">
                    <div id="cart-item">
                        <?php require_once 'components/cart.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<div class="container-fluid">
    <?php
    if (isset($_SESSION['permission'])) {
    ?>
        <h1 style="color:orange;" align="center">Welcome, <?php echo $_SESSION['username']; ?></h1>
            </div>
    <?php
    }
    ?>
    <h1 align="center" class="mt-4 mb-3">Special products</h1>
    <div class="row mx-0 justify-content-center">
        <div id="carouselHome" class="carousel slide d-block w-50 w-md-100" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
                <?php
                $i = 1;
                foreach ($index->getSpecialProducts() as $value) {
                ?>
                    <li data-target="#carouselHome" data-slide-to="<?php echo $i; ?>"></li>
                <?php
                    $i++;
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php
                foreach ($index->getSpecialProducts() as $value) {
                    $i = 0;
                ?>
                    <div class="carousel-item active">
                        <img class="d-block w-100"
                        <?php
                        if (isset($value['image']))
                        { ?>
                            src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("uploads/{$value['image']}")); ?>"
                        <?php
                        } else {
                        ?>
                            src="https://unblast.com/wp-content/uploads/2019/05/Paper-Pouch-Packaging-Mockup-2.jpg"
                        <?php
                        }
                        ?>
                        alt="">
                        <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.5);">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $value['name'] ?></h5>
                                <p class="card-text"><?php echo $value['description'] ?></p> <br>
                                <p class="card-text">Price: <?php echo $value['price'] ?></p> <br>
                                <a href="product?productID=<?php echo $value['productID'] ?>" class="btn btn-orange">View Product</a>
                            </div>
                        </div>
                    </div>
                <?php
                    $i++;
                    if ($i > 0) {
                        break;
                    }
                }
                ?>
                <?php
                $counter = false;
                foreach ($index->getSpecialProducts() as $value) {
                    if (!$counter) {
                        $counter = true;
                    } else {
                ?>
                        <div class="carousel-item">
                            <img class="d-block w-100"
                            <?php
                            if (isset($value['image']))
                            { ?>
                                src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("uploads/{$value['image']}")); ?>"
                            <?php
                            } else {
                            ?>
                                src="https://unblast.com/wp-content/uploads/2019/05/Paper-Pouch-Packaging-Mockup-2.jpg"
                            <?php
                            }
                            ?>
                            alt="">
                            <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.5);">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $value['name'] ?></h5>
                                    <p class="card-text"><?php echo $value['description'] ?></p> <br>
                                    <p class="card-text">Price: <?php echo $value['price'] ?></p> <br>
                                    <a href="product?productID=<?php echo $value['productID'] ?>" class="btn btn-orange">View Product</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="jumbotron jumbotron-fluid mb-0 mt-5">
        <div class="container">
            <h1 class="display-4">News</h1>
            <p class="lead text-body"><?php echo ($index->getNews()['content']) ?></p>
        </div>
    </div>

                <!-- Email Form -->
<div class="d-flex flex-column align-items-center">
<h1 style="color:orange;" class="mt-2">Contact us</h1>
                            <form class="col-3 mt-2" action="" method="post">
                                <div class="form-group">
                                    <label class="font-weight-bold">Name</label>
                                    <input maxlength="50" type="user_name" name="user_name" class="form-control"
                                        placeholder="Enter Your Name" required>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Email</label>
                                    <input maxlength="50" type="user_email" name="user_email" class="form-control"
                                        placeholder="Enter Your Email" required>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Subject</label>
                                    <input maxlength="50" type="subject" name="subject" class="form-control"
                                        placeholder="Enter Your Subject" required>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Message</label>
                                    <textarea maxlength="250" rows="3" type="content" name="content" class="form-control"
                                        required></textarea>
                                </div>
                                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                                <button type="submit" name="submit" class="btn btn-orange">Send Email</button>
                            </form>
                        </div>
</div>

<style>
    <?php include ('style.css'); ?>
</style>
<?php
include("Views/_partials/footer.php");
?>
<?php
require_once('config.php');
$captchaSec = getenv('CAPTCHA_PRIVATE');
?>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $captchaSec; ?>"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute("<?php echo $captchaSec; ?>", { action: 'contact' }).then(function (token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
</script>

<style>
    .container-fluid {
        padding: 0 0 0 0;
    }

    .carousel-inner {
        height: 600px;
    }
    .carousel-item,
    img {
        height: 100% !important;
        width: 100% !important;
    }
    .btn-orange{background-color:#976C42;color: #FFF;}
    .btn-orange:hover{background-color:#49291F;color: #FFF;}
    @media (max-width: 1100px) {
    .w-md-100 {
        width: 100% !important;
    }
    }
</style>