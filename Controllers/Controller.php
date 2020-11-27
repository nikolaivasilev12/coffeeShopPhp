<?php

class Controller extends DBController {

    public static function CreateView($viewName) {
        require_once("Views/$viewName.php");
    }
    public static function CreateChat($viewName, $extension) {
      require_once("Views/components/chatbot/$viewName.$extension");
    }
    public static function loadJS($viewName) {
      require_once("Views/components/js/$viewName.js");
    }
    public static function loadCartHandler($viewName) {
      require_once("Views/components/$viewName.php");
    }
    public function array_flatten($array) { 
        if (!is_array($array)) { 
          return false; 
        } 
        $result = array(); 
        foreach ($array as $key => $value) { 
          if (is_array($value)) { 
            $result = array_merge($result, $this->array_flatten($value)); 
          } else { 
            $result = array_merge($result, array($key => $value));
          } 
        } 
        return $result; 
    }
}
