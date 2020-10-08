<?php
    class Categories extends Controller {
        
    public function getCategory() {
        $categoriesArr = (self::query("SELECT `name` FROM category"));
        return $categoriesArr;
    }
    }
?>