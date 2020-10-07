<?php
class Route {

    public static $validRoutes = array();

    public static function set($route, $function) {

        self::$validRoutes[] = $route;
        
        if($_GET['url'] == $route) {
            $function->__invoke();
        }

    }
}