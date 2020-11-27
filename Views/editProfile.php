<?php
include('Views/_partials/header.php');
$profileObj = new Profile();
$profile = $profileObj->getProfileData($_SESSION['customerID']);
if (isset($_POST['submit'])) {
    $profileObj->updateProfile($_SESSION['customerID'], $_POST);
}
if (isset($_POST['submitPassword'])) {
    $found_user = self::query("SELECT `password` FROM customer WHERE customerID = ? LIMIT 1", array($_SESSION['customerID']));
    if(password_verify($_POST['currentPassword'], $found_user[0]['password'])) {
        if (strcmp($_POST['newPassword'],$_POST['confirmNewPassword']) === 0) {
            $iterations = ['cost' => 15];
            $hashed_password = password_hash($_POST['newPassword'], PASSWORD_BCRYPT, $iterations);
            self::query("UPDATE customer SET password = ?
            WHERE customerID = ? ", array($hashed_password, $_SESSION['customerID']));
        } else {
            echo "Passwords dont match";
        }
    } else {
        echo ('Wrong password');
    }
}
if(!isset($_GET['customerID'])) {
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
                <a href="edit-profile?customerID=<?php echo $_SESSION['customerID']?>">
                    <input class="btn btn-outline-primary profile-button" type="submit" value="Change Password"></input>
                </a>
                </div>
                </div>
                <form action="" method="post">
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">First Name</label>
                            <input maxlength="50" name="fname" type="text" class="form-control" placeholder="John" value="<?php echo ($profile['fname']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Last Name</label>
                            <input maxlength="50" name="lname" type="text" class="form-control" value="<?php echo ($profile['lname']) ?>" placeholder="Doe">
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-start">
                        <div class="col-md-12">
                            <label class="labels">Phone No.</label>
                            <input maxlength="50" name="phoneNr" type="text" class="form-control" placeholder="headline" value="<?php echo ($profile['phoneNr']) ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Email</label>
                            <input maxlength="50" name="email" type="text" class="form-control" placeholder="headline" value="<?php echo ($profile['email']) ?>">
                        </div>
                        <div class="mt-4 col-12 text-left">
                            <input class="btn btn-primary profile-button" name="submit" type="submit" value="Save Profile"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
} elseif (isset($_GET['customerID'])) {
    ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-5 col-md-5 card">
            <div class="p-3 py-5">
                <div class="row">
                <div class="col-7 mb-3">
                    <h3 class="text-left">Edit your profile</h3>
                </div>
                </div>
                <form action="" method="post">
                    <div class="row mt-3 justify-content-start">
                        <div class="col-md-12">
                            <label class="labels">Current Password</label>
                            <input name="currentPassword" type="text" class="form-control" placeholder="*********">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">New Password</label>
                            <input name="newPassword" type="text" class="form-control" placeholder="*********" >
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Confirm New Password</label>
                            <input name="confirmNewPassword" type="text" class="form-control" placeholder="*********" >
                        </div>
                        <div class="mt-4 col-12 text-left">
                            <input class="btn btn-primary profile-button" name="submitPassword" type="submit" value="Save Password"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>