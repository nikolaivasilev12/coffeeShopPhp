<?php
include('Views/_partials/header.php');
$index=new Index();
$admin= new Admin();
$allNews = $admin->getAllNews();
if($_SESSION['permission'] != 'admin') {
    new Redirector('index');
}
if(isset($_POST['saveNews'])) {
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
    <div class="row">
        <div class="col-12 text-center mt-5">
            <h2>
                News history
            </h2>
        </div>
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Content</th>
            <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($allNews as $news) {
                ?>
                    <tr>
                        <th style="width: 5%" scope="row"><?php echo $news['ID'] ?></th>
                        <td style="width: 75%"><?php echo $news['content'] ?></td>
                        <td style="width: 20%"><?php echo $news['date'] ?></td>
                    </tr>
                <?php
                }
            ?>
        </tbody>
        </table>
    </div>
</div>