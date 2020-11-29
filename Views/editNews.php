<?php
include('Views/_partials/header.php');
$index=new Index();
if($_SESSION['permission'] != 'admin') {
    new Redirector('index');
}
if(isset($_POST['saveNews'])) {
    $admin= new Admin();
    $admin->updateNews($_POST['content']);
    new Redirector('admin');
}
?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col text-center">
            <h2 class="pb-2">
                Change News
            </h2>
            <form action="" method="post">
                <textarea rows="5" cols="100" type="text" name="content"><?php echo($index->getNews()['content'])?></textarea> <br>
                <input type="submit" class="btn btn-orange  mt-3" name="saveNews">
            </form>
        </div>
    </div>
</div>