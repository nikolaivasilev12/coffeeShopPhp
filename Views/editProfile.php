<?php
include('header.php');
$profileObj = new Profile();
$profile = $profileObj->getProfileData($_SESSION['customerID']);
// if (isset($_POST['saveCustomerEmail'])) {
//     $profile->updateCustomerEmail($_POST['customerEmail']);
//     print_r($_POST);
// }
// if (isset($_POST['saveCustomerPass'])) {
//     $profile->updateCustomerPass($_POST['customerPassword']);
//     print_r($_POST);
// }
// if (isset($_POST['saveCustomerfName'])) {
//     $profile->updateCustomerfName($_POST['customerfName']);
//     print_r($_POST);
// }
// if (isset($_POST['saveCustomerlName'])) {
//     $profile->updateCustomerlName($_POST['customerlName']);
//     print_r($_POST);
// }
// if (isset($_POST['saveCustomerphoneNr'])) {
//     $profile->updateCustomerphoneNr($_POST['customerphoneNr']);
//     print_r($_POST);
// }
?>





<div class="container">
    <div class="row justify-content-center">
        <div class="mt-5 col-md-5 card">
            <div class="p-3 py-5">
                <div class="row">
                <div class="col-7 mb-3">
                    <h3 class="text-left">Edit your profile</h3>
                </div>
                <div class="col-2 text-right">
                    <input class="btn btn-outline-primary profile-button" type="submit" value="Change Password"></input>
                </div>
                </div>
                <form action="" method="post">
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Name</label>
                            <input type="text" class="form-control" placeholder="first name" value="<?php echo ($profile['fname']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Last name</label>
                            <input type="text" class="form-control" value="<?php echo ($profile['lname']) ?>" placeholder="Doe">
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-start">
                        <div class="col-md-12">
                            <label class="labels">Email</label>
                            <input type="text" class="form-control" placeholder="headline" value="<?php echo ($profile['email']) ?>">
                        </div>
                        <div class="mt-4 col-12 text-left">
                            <input class="btn btn-primary profile-button" type="submit" value="Save Profile"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>