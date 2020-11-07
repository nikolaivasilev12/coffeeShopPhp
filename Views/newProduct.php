<?php
include "header.php";
$admin = new Admin();
$category = new Categories();
/* If user trying to reach page without loggin in - this prevents them */
if ($_SESSION['permission'] != 'admin') {
    new Redirector('index');
}
/* Add new product */
if (isset($_POST['add'])) {
    if (isset($_FILES['file'])) {
        $admin->uploadImage($_FILES);
    }
    $admin->createProduct($_POST['name'], $_POST['description'], $_POST['price'],
    $_POST['stock'], $_POST['origin'], $_POST['type'], $_POST['isSpecial'], $_POST['category']);

    /* JS alert message */
    $PHPtext = "Product Successfully Added!";
}
?>
<script>
var JavaScriptAlert = <?php echo json_encode($PHPtext); ?>;
alert(JavaScriptAlert); // PHP alert
</script>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col text-center">
            <h2>Add New Product</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-row mt-5">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Product Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Product Name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Product Description</label>
                        <textarea name="description" type="text" class="form-control" placeholder="Product Description" required></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Country of Product Origin</label>
                        <input name="origin" type="text" class="form-control" placeholder="Country of Product Origin" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Product Type</label>
                            <input name="type" type="text" class="form-control" placeholder="Product Type" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Price</label>
                            <input name="price" type="number" step="any" class="form-control" placeholder="Price" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Stock</label>
                            <input name="stock" type="number" class="form-control" placeholder="Stock No." required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Special offer?</label>
                            <select name="isSpecial" class="form-control">
                                <option value="0" selected>No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Product Category</label>
                            <select name="category" class="form-control">
                        <?php
                            foreach ($category->getCategory() as $category) {
                                echo
                                    ('<option
                                        name="category" type="submit"
                                    value="'. $category['categoryID'] . '">' . $category['name'] .
                                    '</option>');
                            }
                        ?>
                            </select>
                        </div>
                    </div>
                    <input type="file" name="file">
                    <div class="form-row col-md-6 mt-5">
                        <button type="submit" name="add" class="btn btn-primary">Create</button>
                    </div>
            </form>
        </div>
    </div>
</div>