<?php
include('header.php');
$index=new Index();
if(isset($_POST['saveCompDesc'])) {
    $admin= new Admin();
    $admin->updateCompDesc($_POST['companyDescription']);
    print_r ($_POST);
}

if(isset($_POST['saveCompAddress'])) {
    $admin= new Admin();
    $admin->updateCompAddress($_POST['companyAddress']);
    print_r ($_POST);
}
if(isset($_POST['saveCompPhone'])) {
    $admin= new Admin();
    $admin->updateCompPhone($_POST['companyPhone']);
    print_r ($_POST);
}
if(isset($_POST['saveCompEmail'])) {
    $admin= new Admin();
    $admin->updateCompEmail($_POST['companyEmail']);
    print_r ($_POST);
}
?>

<?php print_r($index->getCompanyData()['companyDescription'] . "<br>" )  ?>
<?php print_r($index->getCompanyData()['adress'] . "<br>" ) ?>
<?php print_r($index->getCompanyData()['phone'] . "<br>" ) ?>
<?php print_r($index->getCompanyData()['email']);


    print_r($index->getWorkdays());
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
            <h4 class="mt-4">Work Hours of the Company</h4>
            <?php

            foreach($index->getWorkdays() as $value){
                ?>
                <div class="d-flex p-2">
                <p><?php print_r($value['startingHour']) ?>&nbsp; - &nbsp; </p>
                <p><?php print_r($value['closingHour']) ?></p>
                <button name="workdays" type="submit" value="<?php print_r($value) ?>"><?php print_r($value['openDay']) ?></button>
                </div>
                <?php
        }
        ?>
        </div>
    </div>
</div>