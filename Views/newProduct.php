<?php
include("header.php");
$admin = new Admin();



?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col text-center">
            <h2>Add New Product</h2>
            <form method="POST">
                <div class="form-row mt-5">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Product Name</label>
                        <input type="text" class="form-control" placeholder="Product Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Product Description</label>
                    <input type="text" class="form-control" placeholder="Product Description">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Country of Product Origin</label>
                        <input type="text" class="form-control" placeholder="Country of Product Origin">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Product Type</label>
                            <input type="text" class="form-control" placeholder="Product Type">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Price</label>
                            <input type="text" class="form-control" placeholder="Price">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Stock</label>
                            <input type="text" class="form-control" placeholder="Stock No.">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Special offer?</label>
                            <select class="form-control">
                                <option selected>No</option>
                                <option>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row col-md-6 mt-5">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
            </form>
        </div>
    </div>
</div>