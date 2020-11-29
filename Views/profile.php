<?php
include("Views/_partials/header.php");
$index = new Index();
$profileObj = new Profile();
$profile = $profileObj->getProfileData($_SESSION['customerID']);
?>
<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <h1 class="text-dark">PROFILE</h1>
    </div>
    <div class="row justify-content-center mb-5">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                    <img height="150" class="rounded-circle"
                src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("assets/nerd.png")); ?>"
            >
                        <div class="mt-3 text-dark">
                            <h4><?php
                                if (strlen($profile['fname']) > 0) {
                                    echo ($profile['fname'] . ' ' . $profile['lname']);
                                } else {
                                    echo 'You havent set a profile name!';
                                }
                                ?></h4>
                            <p class="text-secondary mb-1 font-weight-bold">Email: <?php echo ($profile['email']); ?></p><br>
                            <p class="text-muted font-size-sm font-weight-bold">
                                <?php
                                if (strlen($profile['phoneNr']) > 0) {
                                ?>
                                    Phone Number: <?php echo ($profile['phoneNr']) ?>
                                <?php
                                }
                                ?></p> <br>
                            <a class="btn btn-orange mt-2" href="edit-profile">
                                Edit Personal Information
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <?php
include("Views/_partials/footer.php");
?>
<style>
.btn-orange{background-color:#976C42;color: #FFF;}
.btn-orange:hover{background-color:#49291F;color: #FFF;}
</style>