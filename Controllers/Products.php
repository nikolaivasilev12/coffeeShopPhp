<?php

class Products extends Controller
{
    public function getProducts() {
        $productsArr = (self::query("SELECT * FROM product"));
        return $productsArr;
    }
}


?>