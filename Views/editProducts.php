<?php
include("header.php");
$admin = new Admin();
$catObj = new Categories();
if (isset($_GET['productID'])) {
    $productsObj = new Products();
    $productDetails = $productsObj->getProductDetails($_GET["productID"]);
}
if (isset($_POST['update'])) {
    $admin->updateProductDetails($_POST['name'], $_POST['description'], $_POST['price'], $_POST['stock'], $_POST['origin'], $_POST['type'], $_POST['categoryID']);
}
if (isset($_POST['update'])) {
    $admin->updateProductCategory($_POST['productID'], $_POST['categoryIDs']);
}
if (isset($_POST['delete'])) {
    $admin->deleteCategory($_POST['categoryID']);
}
if (isset($_POST['updateCat'])) {
    $admin->updateProductCategory($_POST['productID'], $_POST['categoryID']);
}
?>
<div class="container">
    <div class="row justify-content-center">
        <h2>ADMIN</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <h2>Products</h2>
        </div>
        <?php
        if (!isset($_GET['productID'])) {
            foreach ($admin->getProducts() as $value) {
                $productCategory = $catObj->getProductCategory($value['productID']);
                echo ('
                <div class="col">
                <div class="card" style="width: 18rem;">
                <div class="card-body">
                Category:
                <strong>
                ');
                if ($productCategory) {
                    print_r($productCategory['name']);
                } else { {
                        print_r('<strong>Not set</strong>');
                    }
                }
                echo ('
                </strong>
                            <h5 class="card-title">' . $value['name'] . '</h5>
                            <p class="card-text">' . $value['description'] . '</p>
                            <p class="card-text">Price:' . $value['price'] . '</p>
                            <a href="edit-products?productID=' . $value['productID'] . '" class="btn btn-primary">Edit Product</a>
                        </div>
                    </div>
                </div>
                    ');
            }
        } else {
            $productCategory = $catObj->getProductCategory($_GET['productID']);
            echo ('
                <form action="" method="post">
                    <div class="row align-items-end">
                        <div class="col-10">
                            ID: ' . $productDetails['productID'] . '
                            <br/>
                            Product Name:<label class="mt-3 mb-0" for="' . $productDetails['name'] . '"><strong>' . $productDetails['name'] . '</strong></label>
                            <input type="hidden" value="' . $productDetails['productID'] . '" name="categoryID" class="form-control">
                            <input type="text" value="' . $productDetails['name'] . '" name="name" class="form-control" id="' . $productDetails['name'] . '" placeholder="Category name">
                            <label class="mb-0 mt-1">Description</label>
                            <textarea type="text" value="' . $productDetails['description'] . '" name="description" class="form-control" placeholder="' . $productDetails['description'] . '"></textarea>
                            <label class="mb-0 mt-1">Price</label>
                            <input type="number" value="' . $productDetails['price'] . '" name="price" class="form-control" placeholder="' . $productDetails['price'] . '"></input>
                            <label class="mb-0 mt-1">Stock</label>
                            <input type="number" value="' . $productDetails['stock'] . '" name="stock" class="form-control" placeholder="' . $productDetails['stock'] . '"></input>
                            <label class="mb-0 mt-1">Origin</label>
                            <input type="text" value="' . $productDetails['origin'] . '" name="origin" class="form-control" placeholder="' . $productDetails['origin'] . '"></input>
                            <label class="mb-0 mt-1">Type</label>
                            <input type="text" value="' . $productDetails['type'] . '" name="type" class="form-control" placeholder="' . $productDetails['type'] . '"></input>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="update" value="Update"/>
                            <input type="submit" name="delete" value="Delete"/>
                        </div>
                    </div>
                </form>
                <form action="" method="post">
                    <div class="row align-items-end">
                        <div class="col-10">
                            <h2> Currently selected category: <br/> <strong>' . $productCategory['name'] . '</strong></h2>
                        </div>
                        <input type="hidden" value="' . $productDetails['productID'] . '" name="productID"">
                        <div class="col-12">
                            <select name="categoryID" ">
                            ');
            foreach ($catObj->getCategory() as $value) {
                echo ('
                                    <option value="' . $value['categoryID'] . '">' . $value['name'] . '</option>
                                ');
            };
            echo ('
                            </select>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="updateCat" value="Update Category"/>
                        </div>
                    </div>
                </form>
                    ');
        }
        ?>
    </div>
</div>