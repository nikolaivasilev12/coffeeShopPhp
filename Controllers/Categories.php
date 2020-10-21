<?php
    class Categories extends Controller {

    public function getCategory() {
        return self::query("SELECT `name`, `categoryID` FROM category");
    }
    public function getProductCategory($productID) {
        $params = array($productID);
        return $this->array_flatten(self::query("SELECT c.name, c.categoryID
        FROM category as c
        INNER JOIN producthascategory as pc
            ON c.categoryID = pc.categoryID
        INNER JOIN product as p
            ON p.productID = pc.productID
        WHERE pc.productID = ? ", $params));
    }
    }