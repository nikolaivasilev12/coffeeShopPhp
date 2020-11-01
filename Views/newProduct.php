<?php
include("header.php");
$admin = new Admin();
/* If user trying to reach page without having permissions - this prevents them */
if ($_SESSION['permission'] != 'admin') {
    new Redirector('index');
}

/* add new product */
if (isset($_POST['add'])) {
    $admin->createProduct($_POST['name'], $_POST['description'], $_POST['price'], $_POST['stock'], $_POST['origin'], $_POST['type'], $_POST['isSpecial']);

    /* JS alert message */
    $PHPtext = "Product Successfully Added!";
}
?>
<script>
    var JavaScriptAlert = <?php echo json_encode($PHPtext); ?>;
    alert(JavaScriptAlert); // Your PHP alert!
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col text-center">
            <h2>Add New Product</h2>
            <form method="POST">
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
                    </div>
                    <div class="form-row col-md-6 mt-5">
                        <button type="submit" name="add" class="btn btn-primary">Create</button>
                    </div>
            </form>
        </div>
    </div>
</div>