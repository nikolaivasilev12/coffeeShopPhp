<?php

class Products extends Controller
{
    public static function getProductsByCategory($category) {
        $productsId = (self::query("SELECT productID FROM productHasCategory WHERE categoryID = '3'"));
        foreach ($productsId as $value) {
            $productByCategory = (self::query("SELECT * FROM product where productID = '$value[productID]'"));
            return($productByCategory);
        }
    }
}


?>