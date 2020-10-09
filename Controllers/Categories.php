<?php
    class Categories extends Controller {

    public function getCategory() {
        $categoriesArr = (self::query("SELECT `name`, `categoryID` FROM category"));
        return $categoriesArr;
    }
    }
?>