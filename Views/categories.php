<?php
include('header.php');
?>
<div class="container">
    <div class="row justify-content-center">
        <h1>Pick a category</h1>
    </div>
    <div class="row justify-content-center">
        <?php
        $catArr = new Categories();
        $products = new Products();
        foreach ($catArr->getCategory() as  $value) {
             
            echo ('
            <a  onclick="myAjax('.$value['name'].')" >
            <div class="col-10 col-md-6 col-lg-4">
                <div class="card my-2" style="width: 18rem; height: 4.5rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center">' . $value['name'] . '</h5>
                    </div>
                </div>
            </div>
            </a>
            ');
            
        }
        ?>
    </div>
</div>
<script>
    function myAjax(value) {
        $.get( 
          'Controllers/getProducts.php'
       ).success(function(resp){
            json = $.parseJSON(resp);
            alert(json);
       });
 }
</script>