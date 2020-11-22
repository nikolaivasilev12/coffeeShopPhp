<?php
class Route {

    public static $validRoutes = array();

    public static function set($route, $function) {

        self::$validRoutes[] = $route;

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        if ($url == $route) {
            $function->__invoke();
            exit;
        }

    }
    public static function notValidRoute() {
        new Redirector('404');
    }
}