<div class="container">
    <div class="row justify-content-center">
        <h1 style="margin-bottom: 3%;">Choose a Category</h1>
    </div>
    <div class="row justify-content-center">
        <a href="product?categoryID=0">
            <button style="margin: 5px;" class="btn btn-outline-dark" name="category" type="submit" value="0">All</button>
        </a>

        <?php
    $catArr = new Categories();
    foreach ($catArr->getCategory() as $value) {
    ?>
        <a href="product?categoryID=<?php echo $value['categoryID'] ?>">
            <button class="btn btn-outline-dark" style="margin: 5px;" name="category" type="submit" value="<?php echo $value['categoryID'] ?>"><?php echo $value['name'] ?></button>
        </a>
        <?php
            }
        ?>
    </div>
    <div class="row justify-content-center">
        <?php
    $productsObj = new Products();
    if (!isset($_GET['categoryID'])) {
        $pages=$productsObj->getProductsPages(0);
    } elseif (isset($_GET['categoryID'])) {
        $pages=$productsObj->getProductsPages(intval($_GET['categoryID']));
    }
    if (isset($_GET['categoryID'])) {
        $categoryIDs = $productsObj->getCategoryIds();
        if (in_array($_GET['categoryID'], $categoryIDs)){
            if (isset($_GET['page']) && $_GET['page'] <= $pages + 1){
                $page = $_GET['page'];
            } elseif (!isset($_GET['page'])) {
                $page = 1;
            } elseif ($_GET['page'] >= $pages + 1){
                new Redirector('product');
            }
            $arr = array(
                'category' => $_GET['categoryID'],
                'page' => $page
            );
        } else {
            new Redirector('product');
        }
    $productsByCategory = $productsObj->getProductByCategory($arr);
    foreach ($productsByCategory as $value) {?>
    <a href="product?productID=<?php echo $value['productID'] ?>" class="custom-card">
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
            <button type="button" id="add_<?php echo $value['productID']; ?>" class="btn btn-orange" data-trigger="focus" data-toggle="popover" data-content="Added to cart"
                onClick="cartAction('add', '<?php echo $value['productID']; ?>','<?php echo $value["name"]; ?>','<?php echo $value["price"]; ?>', '<?php echo $value["stock"]; ?>')">
                Add to cart
            </button>
            <?php
}
        ?>
            <a href="product?productID=<?php echo $value['productID'] ?>"></a>
        </div>
        <?php
}
} elseif (!isset($_GET['categoryID'])) {
    if (isset($_GET['page']) && $_GET['page'] <= $pages + 1){
        $page = $_GET['page'];
    } elseif (isset($_GET['page']) && $_GET['page'] >= $pages + 1) {
        new Redirector('product');
    } else {
        $page = 1;
    }
    $arr = array(
        'category' => 0,
        'page' => $page
    );
    $productsByCategory = $productsObj->getProductByCategory($arr);
    foreach ($productsByCategory as $value) {?>
        <a href="product?productID=<?php echo $value['productID'] ?>" class="custom-card">
        <div class="product-item card col-3 mx-2 my-2 shadow p-3 mb-5 bg-white rounded">
            <div class="image">
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
                    id="<?php echo $value['productID']; ?>" width="100%">
            </div>
            <div>
                <strong><?php echo $value["name"]; ?></strong>
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
            <button type="button" id="add_<?php echo $value['productID']; ?>" class="btn btn-orange" data-trigger="focus" data-toggle="popover" data-content="Added to cart"
                onClick="cartAction('add', '<?php echo $value['productID']; ?>','<?php echo $value["name"]; ?>','<?php echo $value["price"]; ?>','<?php echo $value["stock"]; ?>');openCart()">
                Add to cart
            </button>
            <?php
}
        ?>
            <a href="product?productID=<?php echo $value['productID'] ?>"></a>
        </div>
        

    <?php
}
}
?>
    </div>
    <div class="row justify-content-center">
<nav aria-label="Page navigation example">
<ul class="pagination">
<!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
<?php
for ($x = 0; $x <= $pages; $x++) {
    ?>
    <li class="page-item">
        <a class="page-link" href="<?php
            /* Get the url and parse it checking if it has a php query (variable) */
            $url = $_SERVER['REQUEST_URI'];
            $query = parse_url($url, PHP_URL_QUERY);

            /* Removes the numbers from the string variables (they are variables and we want 
            their names not their value becuase the value will differ) */
            $queryNoNum = preg_replace('/[0-9]+/', '', $query);

            /* Check if the query var exist and if the query (without its number) matches 
            add the &page=(here is the number of the page which is equal to the iteration number + 1 because
            it starts from 0) to the $url variable    */
            if ($query && $queryNoNum === 'categoryID=') {
                $url .= '&page='. strval($x+1);
            } elseif ($queryNoNum === 'categoryID=&page=') {
                /* Since here we have a case where the query has two variables the first thing we to is to
                get the $pageNum from the query (including the value) and then we replace the 
                $url variable with the page that we desire (it would be the iteration + 1)  */
                $pageNum = substr($url, strrpos( $url, '&' )+1);
                $url= str_replace("$pageNum","page=". strval($x+1),"$url");
            } elseif ($queryNoNum === 'page=') {
                $url = str_replace("$query","page=". strval($x+1),"$url");
            } elseif ($queryNoNum !== 'page=') {
                $url .= '?page='. strval($x+1);
            }
            echo $url;
            ?>">
            <?php 
            echo $x+1;
            ?>
        </a>
    </li>
    <?php
} ?>
<!-- <li class="page-item"><a class="page-link" href="#">Next</a></li>  -->
</ul>
</nav>
    </div>
</div>
<script> 
$("[data-toggle=popover]").popover();
</script>

<style>

.btn-orange{background-color:#976C42;color: #FFF;}
.btn-orange:hover{background-color:#49291F;color: #FFF;}

</style>