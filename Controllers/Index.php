<?php

class Index extends Controller {
    public function getSpecialProducts() {
       return self::query("SELECT * FROM product WHERE isSpecial = 1");
    }
    public function getNews() {
        return $this->array_flatten(self::query("SELECT * FROM news"));
    }
    public function getCompanyData() {
        return $this->array_flatten(self::query("SELECT * FROM companydata"));
    }
}