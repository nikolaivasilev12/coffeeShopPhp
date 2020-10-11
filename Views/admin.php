<?php
include("header.php");
// $admin = new Admin();
// if (isset($_POST['submit'])) {
//     $admin->saveCategory($_POST['name'],$_POST['description'],$_POST['categoryID']);
// }
?>
<div class="container">
<div class="row justify-content-center">
    <h2>ADMIN</h2>
</div>
<div class="row">
    <div class="col text-center">
        <a href="edit-categories" class="card">
            Edit Categories
        </a>
    </div>
    <div class="col text-center">
        <a class="card">
            Edit Products
        </a>
    </div>
</div>
<!-- <h2>Categories</h2> -->
<?php
// foreach ($admin->getCategories() as  $value) {
//     echo ('
//     <form action="" method="post">
//         <div class="row align-items-end">
//             <div class="col-4">
//                 <label for="' . $value['categoryID'] . '">' . $value['name'] . '</label>
//                 <input type="hidden" value="' . $value['categoryID'] . '" name="categoryID" class="form-control">
//                 <input type="text" name="name" class="form-control" id="' . $value['categoryID'] . '" placeholder="Category name">
//                 <input type="text" name="description" class="form-control" id="' . $value['categoryID'] . '" placeholder="Description">
//             </div>
//             <div class="col-2">
//                 <input type="submit" name="submit" value="Save"/>
//             </div>
//         </div>
//     </form>
//     ');
// }
?>
<!-- <h2>Products</h2> -->
<?php
// $productsArr = new Admin();
// foreach ($catArr->getProducts() as $value) {
//     echo ('
//         <a href="categories?categoryID=">
//         ' . $value['name'] . '
//             <button name="category" type="submit" value="">' . $value['price'] . '</button>
//         </a>');
// }
?>

</div>
