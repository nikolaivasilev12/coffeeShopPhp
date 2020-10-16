<?php
$session = new SessionHandle();
include("header.php");
?>
<style> <?php include 'style.css'; ?> </style>
<div class="container">
    <div class="row justify-content-center">
        <h1>ADMIN</h1>
    </div>
        <h3 class="mt-4">Product Controls</h3>
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

    </div>
    <div class="col text-center mt-4">
        <h2>News & Company</h2>
            <div class="row">
        <div class="col text-center">
            <a href="edit-news" class="card">
                Edit News
            </a>
        </div>
        <div class="col text-center">
            <a href="" class="card">
               Edit Description of the Company
            </a>
        </div>
        <div class="col text-center">
            <a href="" class="card">
                Edit Email
            </a>
        </div>
        <div class="col text-center">
            <a href="" class="card">
               Edit Phone No.
            </a>
        </div>
        <div class="col text-center">
            <a href="" class="card">
                Edit Opening Hours
            </a>
        </div>
</div>
</div>
</div>