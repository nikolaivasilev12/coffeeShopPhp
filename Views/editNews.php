<?php
include('header.php');
$index=new Index();
if($_SESSION['permission'] != 'admin') {
    new Redirector('index');
}
if(isset($_POST['saveNews'])) {
    $admin= new Admin();
    $admin->updateNews($_POST['content']);
}
?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col text-center">
            <h2>
                Edit News
            </h2>
            <form action="" method="post">
                <input type="text" name="content" value="<?php echo($index->getNews()['content'])?>">
                <input type="submit" class="btn btn-primary" name="saveNews">
            </form>
        </div>
    </div>
</div>