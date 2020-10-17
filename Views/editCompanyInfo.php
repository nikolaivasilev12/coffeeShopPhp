<?php
include('header.php');
$index=new Index();
if(isset($_POST['saveCompDesc'])) {
    $admin = new Admin();
    $admin->updateCompDesc($_POST['companyDescription']);
    print_r ($_POST);
}

if(isset($_POST['saveCompAddress'])) {
    $admin = new Admin();
    $admin->updateCompAddress($_POST['companyAddress']);
    print_r ($_POST);
}
if(isset($_POST['saveCompPhone'])) {
    $admin = new Admin();
    $admin->updateCompPhone($_POST['companyPhone']);
    print_r ($_POST);
}
if(isset($_POST['saveCompEmail'])) {
    $admin = new Admin();
    $admin->updateCompEmail($_POST['companyEmail']);
    print_r ($_POST);
}
if(isset($_POST['saveHours'])) {
    $admin = new Admin();
    $admin->updateHours($_POST['startingHours'], $_POST['closingHours'], $_POST['ID']);
    print_r ($_POST);
}
?>


<div class="container">
            <h2 class="text-center">
                Edit Information About the Company
            </h2>
    <div class="row justify-content-center">
        <div class="col text-center">
            <h4 class="mt-4">Description of the Company</h4>
            <form action="" method="post">
                <input type="text" name="companyDescription" value="<?php echo($index->getCompanyData()['companyDescription'])?>">
                <input type="submit" name="saveCompDesc">
            </form>
            <h4 class="mt-4">Address of the Company</h4>
            <form action="" method="post">
                <input type="text" name="companyAddress" value="<?php echo($index->getCompanyData()['adress'])?>">
                <input type="submit" name="saveCompAddress">
            </form>
            <h4 class="mt-4">Phone No. of the Company</h4>
            <form action="" method="post">
                <input type="text" name="companyPhone" value="<?php echo($index->getCompanyData()['phone'])?>">
                <input type="submit" name="saveCompPhone">
            </form>
            <h4 class="mt-4">Email of the Company</h4>
            <form action="" method="post">
                <input type="text" name="companyEmail" value="<?php echo($index->getCompanyData()['email'])?>">
                <input type="submit" name="saveCompEmail">
            </form>

            <!-- workworkdays loop -->
            <h4 class="mt-4">Working time of the Company</h4>
            <?php
            foreach($index->getWorkdays() as $value){
                ?>
                <div class="wrapper justify-start d-flex p-2">
                <p> <span class="font-weight-bold"><?php print_r($value['openDay']) ?> </span>
                Opening at:&nbsp;
                <form action="" method="POST">
                <input type="hidden" name="ID" value="<?php print_r($value['ID']) ?>">
                <input type="text" name="startingHours" value="<?php print_r($value['startingHour']) ?>">
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
</div>