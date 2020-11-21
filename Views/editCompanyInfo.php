<?php
include('header.php');

if($_SESSION['permission'] != 'admin') {
    new Redirector('index');
}
$index = new Index();
if (isset($_POST['submit'])) {
    $admin = new Admin();
    $admin->updateCompanyData($_POST);
}
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
            <!-- work days loop -->
            <div class="col-md-12 pb-4">
                <h4 class="mt-4 text-center">Company's working hours</h4>
            </div>
            <?php
            foreach ($index->getWorkdays() as $value) {
            ?>
                <div class="col-md-3 wrapper d-flex justify-content-center">
                    <span> <span class="font-weight-bold"><?php print_r($value['openDay']) ?> </span> <br>
                        Opening at:&nbsp;
                        <form action="" method="POST">
                            <input type="hidden" name="ID" value="<?php print_r($value['ID']) ?>">
                            <input type="text" name="startingHours" value="<?php print_r($value['startingHour']) ?>">
                           <br> Closing at:&nbsp; <br>
                            <input type="text" name="closingHours" value="<?php print_r($value['closingHour']) ?>"> <br>
                            <button  class="mt-2 btn btn-primary" name="saveHours" type="submit" value="<?php print_r($value) ?>">Submit</button>
                        </form>
                    </span>
                </div>
            <?php
            }
            ?>
    </div>
</div>