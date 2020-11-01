<?php
include("header.php");
$index = new Index();
$profileObj = new Profile();
$profile = $profileObj->getProfileData($_SESSION['customerID']);
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <h1>PROFILE</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h4><?php
                                if (strlen($profile['fname']) > 0) {
                                    echo ($profile['fname'] . ' ' . $profile['lname']);
                                } else {
                                    echo 'You havent set a profile name!';
                                }
                                ?></h4>
                            <p class="text-secondary mb-1">Developer</p>
                            <p class="text-secondary mb-1">Email: <?php echo ($profile['email']); ?></p>
                            <p class="text-muted font-size-sm">
                                <?php
                                if (strlen($profile['phoneNr']) > 0) {
                                ?>
                                    Phone Number: <?php echo ($profile['phoneNr']) ?>
                                <?php
                                }
                                ?></p>
                            <a class="btn btn-orange" href="edit-profile">
                                Edit Personal Information
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
include("footer.php");
?>
<style>
.btn-orange{background-color:#976C42;color: #FFF;}
.btn-orange:hover{background-color:#49291F;color: #FFF;}</style>