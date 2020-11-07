<?php
include("header.php");
if ($_SESSION['permission'] != 'admin') {
    new Redirector('index');
}
$admin = new Admin();
$catObj = new Categories();
if (isset($_GET['productID'])) {
    $productsObj = new Products();
    $productDetails = $productsObj->getProductDetails($_GET["productID"]);
}
if (isset($_POST['update'])) {
    if (isset($_POST['isSpecial'])) {
        $admin->updateProductDetails($_POST['name'], $_POST['description'], $_POST['price'], $_POST['stock'], $_POST['origin'], $_POST['type'], $_POST['productID']);
        $admin->updateProductIsSpecial($_POST['productID'], $_POST['isSpecial']);
    } else {
        $admin->updateProductDetails($_POST['name'], $_POST['description'], $_POST['price'], $_POST['stock'], $_POST['origin'], $_POST['type'], $_POST['productID']);
    }
}
if (isset($_POST['updateCat'])) {
    $admin->updateProductCategory($_POST['productID'], $_POST['categoryID']);
}
if (isset($_POST['delete'])) {
    $admin->deleteProduct($_POST['productID']);
}
?>
<div class="container">
    <div class="row justify-content-center mt-5 mb-4">
        <h2>Edit Products</h2>
    </div>
    <div class="row justify-content-center">
        <?php
        if (!isset($_GET['productID'])) {
            foreach ($admin->getProducts() as $value) {
                $productCategory = $catObj->getProductCategory($value['productID']);
        ?>
            <div class="product-item card col-3 mx-2 my-2 shadow p-3 mb-5 bg-white rounded">
            <div class="product-image">
            <img
            <?php if (isset($value['image'])) 
            { ?>
                src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("uploads/{$value['image']}")); ?>"
            <?php
            } else {
            ?>
                src="https://unblast.com/wp-content/uploads/2019/05/Paper-Pouch-Packaging-Mockup-2.jpg"
            <?php
            }
            ?>
            id="<?php echo $value['productID']; ?>" width="100%;">
            </div>
            <div>
                <strong><?php echo $value["name"]; ?></strong>
            </div>
            <div>
                Category:
            <strong>
                <?php
                if ($productCategory) {
                    print_r($productCategory['name']);
                } else { {
                        print_r('<strong>Not set</strong>');
                    }
                }
                ?>
            </strong>
            </div>
            <div class="product-price"><?php echo $value["price"] . " DKK"; ?></div>
            <?php if ($value['stock'] == 0) {?>
            <p class="mt-4">
                <strong>Out of stock</strong>
            </p>
            <?php
} else {?>
            <p>
                Currently in stock:
                <strong>
                    <?php echo $value["stock"]; ?>
                </strong>
            </p>
            </a>
            <a href="edit-products?productID=<?php echo $value['productID'] ?>" class="btn btn-orange">Edit Product</a>
            <?php
}
        ?>
            <a href="product?productID=<?php echo $value['productID'] ?>"></a>
        </div>
                    <!-- <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            Category:
                            <strong>
                                <?php
                                if ($productCategory) {
                                    print_r($productCategory['name']);
                                } else { {
                                        print_r('<strong>Not set</strong>');
                                    }
                                }
                                ?>
                            </strong>
                            <h5 class="card-title"><?php echo $value['name'] ?></h5>
                            <p class="card-text"><?php echo $value['description'] ?></p>
                            <p class="card-text"><?php echo $value['price'] ?></p>
                            <a href="edit-products?productID=<?php echo $value['productID'] ?>" class="btn btn-primary">Edit Product</a>
                        </div>
                    </div> -->
            <?php
            }
        } else {
            $productCategory = $catObj->getProductCategory($_GET['productID']);
            ?>
            <div class="col">
            <form action="" method="post">
                <div class="row align-items-end">
                    <div class="col-10">
                        ID: <?php echo $productDetails['productID'] ?>
                        <br />
                        <div class="form-group">
                            Product Name:
                            <label class="mt-3 mb-0 font-weight-bold" for="<?php echo $productDetails['name'] ?>">
                                <?php echo $productDetails['name'] ?>
                            </label>
                            <input type="hidden" value="<?php echo $productDetails['productID'] ?>" name="productID" class="form-control">
                            <input type="text" value="<?php echo $productDetails['name'] ?>" name="name" class="form-control" id="<?php echo $productDetails['name'] ?>" placeholder="Category name">
                        </div>
                        <div class="form-group">
                            <label class="mb-0 mt-1 font-weight-bold">
                                Description
                            </label>
                            <textarea type="text" value="<?php echo $productDetails['description'] ?>" name="description" class="form-control" placeholder="<?php echo $productDetails['description'] ?>"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="mb-0 mt-1 font-weight-bold">Price</label>
                            <input type="number" value="<?php echo $productDetails['price'] ?>" name="price" class="form-control" placeholder="<?php echo $productDetails['price'] ?>"></input>
                        </div>
                        <div class="form-group">
                            <label class="mb-0 mt-1 font-weight-bold">Stock</label>
                            <input type="number" value="<?php echo $productDetails['stock'] ?>" name="stock" class="form-control" placeholder="<?php echo $productDetails['stock'] ?>"></input>
                        </div>
                        <div class="form-group">
                            <label class="mb-0 mt-1 font-weight-bold">Origin</label>
                            <input type="text" value="<?php echo $productDetails['origin'] ?>" name="origin" class="form-control" placeholder="<?php echo $productDetails['origin'] ?>"></input>
                        </div>
                        <div class="form-group">
                            <label class="mb-0 mt-1 font-weight-bold">Type</label>
                            <input type="text" value="<?php echo $productDetails['type'] ?>" name="type" class="form-control" placeholder="<?php echo $productDetails['type'] ?>"></input>
                        </div>
                        <div class="form-group">
                            <?php 
                            $input = $productDetails['isSpecial'] != 1 ? '<input type="checkbox" value="1" name="isSpecial" class="form-check-input"></input>' : '
                            <input type="checkbox" value="1" checked="checked" name="isSpecial" class="form-check-input"></input>';
                            echo($input);
                            ?>
                            <label for="isSpecial" class="font-weight-bold form-check-label">Toggle Special product</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <input class="btn btn-primary" type="submit" name="update" value="Update" />
                        <input class="btn btn-outline-danger"type="submit" name="delete" value="Delete"/>
                    </div>
                </div>
            </form>
            </div>
            <div class="col">
            <form action="" method="post">
                <div class="row align-items-end">
                    <div class="col-10">
                        <h2> Currently selected category: <br /> <strong>
                                <?php
                                if (isset($productCategory['name'])) {
                                    echo ($productCategory['name']);
                                } else {
                                    echo ('No category selected');
                                }
                                ?>
                            </strong></h2>
                    </div>
                    <div class="form-group">
                    <input type="hidden" value="<?php echo ($productDetails['productID']) ?>" name="productID"">
                        <div class=" col-12">
                    <select name="categoryID" ">
                            <?php
                            foreach ($catObj->getCategory() as $value) {
                            ?>
                    <option value=" <?php echo $value['categoryID'] ?>"><?php echo $value['name'] ?></option>
                    <?php
                            };
                    ?>
                    </select>
                    </div>
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-primary"name="updateCat" value="Update Category" />
                </div>
            </form>
        </div>
    </div>
<?php
        }
?>
</div>
</div>