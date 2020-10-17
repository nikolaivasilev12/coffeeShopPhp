<?php
include('header.php');
$profile=new Profile();
print_r($_SESSION['customerID']);
if(isset($_POST['saveCustomerEmail'])) {
    $profile->updateCustomerEmail($_POST['customerEmail']);
    print_r ($_POST);
}
if(isset($_POST['saveCustomerPass'])) {
    $profile->updateCustomerPass($_POST['customerPassword']);
    print_r ($_POST);
}
if(isset($_POST['saveCustomerfName'])) {
    $profile->updateCustomerfName($_POST['customerfName']);
    print_r ($_POST);
}
if(isset($_POST['saveCustomerlName'])) {
    $profile->updateCustomerlName($_POST['customerlName']);
    print_r ($_POST);
}
if(isset($_POST['saveCustomerphoneNr'])) {
    $profile->updateCustomerphoneNr($_POST['customerphoneNr']);
    print_r ($_POST);
}
?>




   
<div class="container">
            <h2 class="text-center">
            EDIT YOUR PROFILE
            </h2>
    <div class="row justify-content-center">
        <div class="col-4 text-center">
            <h4 class="mt-4">Email</h4>
            <form action="" method="post">
                <input type="text" name="customerEmail" value="<?php print_r($profile->getCustomerEmail($_SESSION['customerID'])[0]['email']);  ?>">
                <input type="submit" class="btn btn-primary" type="submit" name="saveCustomerEmail">
            </form>
            <h4 class="mt-4">Password</h4>
            <form action="" method="post">
                <input type="text" name="customerPassword" value="<?php print_r($profile->getCustomerPassword($_SESSION['customerID'])[0]['password']);  ?>">
                <input class="btn btn-primary" type="submit" name="saveCustomerPassword">
            </form>
            <h4 class="mt-4">Your First Name</h4>
            <form  action="" method="post">
                <input type="text" name="customerfName" value="<?php print_r($profile->getCustomerfName($_SESSION['customerID'])[0]['fname']);  ?>">
                <input class="btn btn-primary" type="submit" name="saveCustomerfName">
            </form>
            <h4 class="mt-4">Your Last Name</h4>
            <form action="" method="post">
                <input type="text" name="customerlName" value="<?php print_r($profile->getCustomerlName($_SESSION['customerID'])[0]['lname']);  ?>">
                <input class="btn btn-primary" type="submit" name="saveCustomerlName">
            </form>
            <h4 class="mt-4">Your Phone Number</h4>
            <form action="" method="post">
                <input type="text" name="customerPhone" value="<?php print_r($profile->getCustomerphoneNr($_SESSION['customerID'])[0]['phoneNr']);  ?>">
                <input class="btn btn-primary" type="submit" name="saveCustomerphoneNr">
            </form>
        </div>
    </div>
</div>

