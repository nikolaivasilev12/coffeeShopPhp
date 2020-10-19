<?php
include('header.php');
$index = new Index();
if (isset($_POST['submit'])) {
    $admin = new Admin();
    $admin->updateCompanyData($_POST);
}

// if (isset($_POST['saveCompAddress'])) {
//     $admin = new Admin();
//     $admin->updateCompAddress($_POST['companyAddress']);
//     print_r($_POST);
// }
// if (isset($_POST['saveCompPhone'])) {
//     $admin = new Admin();
//     $admin->updateCompPhone($_POST['companyPhone']);
//     print_r($_POST);
// }
// if (isset($_POST['saveCompEmail'])) {
//     $admin = new Admin();
//     $admin->updateCompEmail($_POST['companyEmail']);
//     print_r($_POST);
// }
// if (isset($_POST['saveHours'])) {
//     $admin = new Admin();
//     $admin->updateHours($_POST['startingHours'], $_POST['closingHours'], $_POST['ID']);
//     print_r($_POST);
// }
?>


<div class="container">
    <h2 class="text-center">
        Edit Information About the Company
    </h2>
    <div class="row justify-content-center">
        <div class="col-8">
        <form action="" method="post">
            <div class="row mt-2">
                <div class="col-md-6">
                    <label class="labels">Company Phone No.</label>
                    <input name="phone" type="text" class="form-control" value="<?php echo ($index->getCompanyData()['phone']) ?>" placeholder="Doe">
                </div>
                <div class="mt-3 col-md-12">
                    <label class="labels">Company Address</label>
                    <input name="adress" type="text" class="form-control" placeholder="first name" value="<?php echo ($index->getCompanyData()['adress']) ?>">
                </div>
            </div>
            <div class="row mt-3 justify-content-start">
                <div class="col-md-12">
                    <label class="labels">Company Email</label>
                    <input name="email" type="text" class="form-control" placeholder="headline" value="<?php echo ($index->getCompanyData()['email']) ?>">
                </div>
                <div class="mt-3 col-md-12">
                    <label class="labels">Company Description</label>
                    <textarea name="companyDescription" type="text" class="form-control" placeholder="Write your company's description here"><?php echo($index->getCompanyData()['companyDescription']); ?></textarea>
                </div>
                <div class="mt-4 col-12 text-left">
                    <input class="btn btn-primary profile-button" name="submit" type="submit" value="Save Profile"></input>
                </div>
            </div>
        </form>
        </div>
            <!-- <h4 class="mt-4">Description of the Company</h4>
            <form action="" method="post">
                <input type="text" name="companyDescription" value="<?php echo ($index->getCompanyData()['companyDescription']) ?>">
                <input type="submit" name="saveCompDesc">
            </form>
            <h4 class="mt-4">Address of the Company</h4>
            <form action="" method="post">
                <input type="text" name="companyAddress" value="<?php echo ($index->getCompanyData()['adress']) ?>">
                <input type="submit" name="saveCompAddress">
            </form>
            <h4 class="mt-4">Phone No. of the Company</h4>
            <form action="" method="post">
                <input type="text" name="companyPhone" value="<?php echo ($index->getCompanyData()['phone']) ?>">
                <input type="submit" name="saveCompPhone">
            </form>
            <h4 class="mt-4">Email of the Company</h4>
            <form action="" method="post">
                <input type="text" name="companyEmail" value="<?php echo ($index->getCompanyData()['email']) ?>">
                <input type="submit" name="saveCompEmail">
            </form> -->

            <!-- work days loop -->
            <div class="col-12">
                <h4 class="mt-4 text-center">Working time of the Company</h4>
            </div>
            <?php
            foreach ($index->getWorkdays() as $value) {
            ?>
                <div class="wrapper justify-start d-flex p-2">
                    <p> <span class="font-weight-bold"><?php print_r($value['openDay']) ?> </span>
                        Opening at:&nbsp;
                        <form action="" method="POST">
                            <input type="hidden" name="ID" value="<?php print_r($value['ID']) ?>">
                            <input type="text" name="startingHours" value="<?php print_r($value['startingHour']) ?>">
                            Closing at:&nbsp;
                            <input type="text" name="closingHours" value="<?php print_r($value['closingHour']) ?>">
                            <button class="ml-5" name="saveHours" type="submit" value="<?php print_r($value) ?>">Submit</button>
                        </form>
                    </p>
                </div>
            <?php
            }
            ?>
    </div>
</div>