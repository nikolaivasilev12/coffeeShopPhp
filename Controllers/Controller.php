<?php

class Controller extends DBController {

    public static function CreateView($viewName) {
        require_once("Views/$viewName.php");
    }
}

?>