<?php
class CartController
{
    public $itemArray;
    public $newItemArray;
    public function existingCart($existingItems)
    {
        if (!empty($existingItems)) {
            $this->itemArray["cartItem"] = $existingItems;
        }
    }
    public function cartAdd($name, $quantity)
    {
        $db_handle = new DBController();
        if (!empty($quantity)) {
            $productByName = $db_handle->runQuery("SELECT * FROM products WHERE `name`='" . $name . "'");
            $this->newItemArray = array($productByName[0]["name"] => array(
                'name' => $productByName[0]["name"],
                'type' => $productByName[0]["type"],
                'quantity' => $_POST["quantity"],
                'price' => $productByName[0]["price"]));

            if (!empty($this->itemArray["cartItem"])) {
                if (in_array($productByName[0]["name"], array_keys($this->itemArray["cartItem"]))) {
                    foreach ($this->itemArray["cartItem"] as $k => $v) {
                        if ($productByName[0]["name"] == $k) {
                            if (empty($this->itemArray["cartItem"][$k]["quantity"])) {
                                $this->itemArray["cartItem"][$k]["quantity"] = 0;
                            }
                            $this->itemArray["cartItem"][$k]["quantity"] += $_POST["quantity"];
                        }
                    }
                } else {
                    $this->itemArray["cartItem"] = array_merge($this->itemArray["cartItem"], $this->newItemArray);
                }
            } else {
                $this->itemArray["cartItem"] = $this->newItemArray;
            }
        }
    }

    public function cartRemove($name){
    //Remove item from cart
        if (!empty($this->itemArray["cartItem"])) {
            foreach ($this->itemArray["cartItem"] as $k => $v) {
                if ($name == $k)
                    unset($this->itemArray["cartItem"][$k]);
                if (empty($this->itemArray["cartItem"]))
                    unset($this->itemArray["cartItem"]);
            }
        }
    }
    public function __destruct() {
        //$_SESSION["cart_item"] = $this->itemArray;
    }
}