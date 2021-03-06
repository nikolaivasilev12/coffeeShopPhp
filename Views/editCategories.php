<?php
include("Views/_partials/header.php");
$admin = new Admin();
if ($_SESSION['permission'] != 'admin') {
    new Redirector('index');
}
if (isset($_POST['update'])) {
    $admin->updateCategory($_POST['name'], $_POST['description'], $_POST['categoryID']);
}
if (isset($_POST['add'])) {
    $admin->createCategory($_POST['name'], $_POST['description']);
}
if (isset($_POST['delete'])) {
    $admin->deleteCategory($_POST['categoryID']);
}
?>
<div class="row justify-content-center mt-5">
    <h2>Edit categories</h2>
</div>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2>Categories</h2>
            <?php
            foreach ($admin->getCategories() as  $value) {
                ?>
                <form action="" method="post">
                    <div class="row align-items-end">
                        <div class="col-10">
                            Category Name:<label class="mt-3 mb-0" for="<?php echo $value['categoryID'] ?>"><strong><?php echo $value['name'] ?></strong></label>
                            <input type="hidden" value="<?php echo $value['categoryID'] ?>" name="categoryID" class="form-control">
                            <input type="text" value="<?php echo $value['name'] ?>" name="name" class="form-control" placeholder="Category name">
                            <label class="mb-0 mt-1">Description</label>
                            <textarea type="text" name="description" class="form-control"><?php echo $value['description'] ?></textarea>
                        </div>
                        <div class="col-2">
                            <input type="submit" name="update" class="btn btn-orange btn-block"value="Update"/>
                            <input type="submit" name="delete" class="btn btn-outline-danger btn-block" value="Delete"/>
                        </div>
                    </div>
                </form>
              <?php
            }
            ?>
        </div>
        <div class="col">
            <form action="" method="post">
                <h2>Create a new category</h2>
                <input type="text" name="name" class="form-control" placeholder="Category name">
                <input type="text" name="description" class="form-control" placeholder="Description">
                <input type="submit" class="btn btn-orange  btn-block mt-2"name="add" value="Add" />
            </form>
        </div>
    </div>
    <div>

    </div>
</div>