<?php
include('header.php');
$index=new Index();
if(isset($_POST['saveNews'])) {
    $admin= new Admin();
    $admin->updateNews($_POST['content']);
    print_r ($_POST);
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col text-center">
            <h2>
                Edit News
            </h2>
            <form action="" method="post">
                <input type="text" name="content" value="<?php echo($index->getNews()['content'])?>">
                <input type="submit" name="saveNews">
            </form>
        </div>
    </div>
</div>