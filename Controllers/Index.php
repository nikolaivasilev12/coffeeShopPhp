<?php

class Index extends Controller {
    public function getSpecialProducts() {
       return self::query("SELECT * FROM product WHERE isSpecial = 1");
    }
}

?>