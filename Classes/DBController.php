  
<?php
class DBController
{
        
    private static function con() {
    $user = "admin";
    $pass = "123456";

    $pdo = new PDO('mysql:host=localhost;dbname=coffeeshopdb;charset=utf8', $user, $pass);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
    }

    public static function query($query, $params = array()) {
    $stmt = self::con()->prepare($query);
    $stmt->execute($params);
    $data = $stmt->fetchAll();
    return $data;
    }
}