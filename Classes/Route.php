<?php
class Route {

    public static $validRoutes = array();

    public static function set($route, $function) {

        self::$validRoutes[] = $route;

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        
        if ($url == $route) {
            $function->__invoke();
        }else if ($url == null){
            header('location: ' . 'index');
            exit;
        }

    }
}