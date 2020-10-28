<?php
include("header.php");
if ($_SESSION['permission'] != 'admin') {
    new Redirector('index');
}
?>
<div class="container">
    <div class="row justify-content-center">
        <h1>ADMIN PANEL</h1>
    </div>
    <h3 class="mt-5 text-center">Product Controls</h3>
    <div class="row">
        <div class="col text-center">
            <a href="edit-categories" class="card">
                Edit Categories
            </a>
        </div>
        <div class="col text-center">
            <a href="edit-products" class="card">
                Edit Products
            </a>
        </div>
        <div class="col text-center">
            <a href="new-product" class="card">
                Add Product
            </a>
        </div>

    </div>
    <div class="col text-center mt-4">
        <h3>News & Company</h3>
        <div class="row">
            <div class="col text-center">
                <a href="orders" class="card">
                    View Orders
                </a>
            </div>
            <div class="col text-center">
                <a href="edit-news" class="card">
                    Edit News
                </a>
            </div>
            <div class="col text-center">
                <a href="edit-company" class="card">
                    Edit Company's Information
                </a>
            </div>
        </div>
    </div>
</div>